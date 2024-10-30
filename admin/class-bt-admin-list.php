<?php

class BloggingToolsAdminList {

  /**
   * Custom columns for posts.
   *
   * @since    1.0.0
   */
  public function post_custom_columns($columns) {
    $columns['word_count'] = __('Word count', 'blogging-tools');
    $columns['image_count'] = __('Images', 'blogging-tools');
    $columns['links'] = __('Links', 'blogging-tools');
    return $columns;
  }

  /**
   * Custom column content for posts.
   *
   * @since    1.0.0
   */
  public function post_custom_columns_content($column_name, $post_id) {

    $post_content = get_the_content($post_id);

    switch ($column_name) {
      
      case 'word_count':
        $word_count = str_word_count($post_content);
        echo $word_count;
        break;

      case 'image_count':        
        echo self::getImageCount($post_content);
        break;

      case 'links':

        echo '<div class="blogging-tools-admin-links-container">';

        echo '<table class="blogging-tools-admin-links">';

        echo '<tr><td>' . __('Outlinks', 'blogging-tools') . '</td><td>' . self::getTotalLinks($post_content) . '</td></tr>';
        echo '<tr><td>' . __('Internal', 'blogging-tools') . '</td><td>' . self::getLinks($post_content, 'internal') . '</td></tr>';
        echo '<tr><td>' . __('External', 'blogging-tools') . '</td><td>' . self::getLinks($post_content, 'external') . '</td></tr>';

        echo '</table>';

        echo '</div>';

        break;

    }

  }

  private static function getImageCount($post_content = '') {
  
    $image_count = 0;
    
    preg_match_all('/(<img\s)/', $post_content, $images);
    
    if (is_array($images)) {
      $image_count = sizeof($images[0]);
    }
    
    return $image_count;
  
  }

  private static function getTotalLinks($post_content = '') {
  
    $link_count = 0;

    preg_match_all('/<a.*?href="(.*?)".*?<\/a>/', $post_content, $links);
    
    if (is_array($links)) {
      $link_count = sizeof($links[0]);
    }
    
    return $link_count;
  
  }

  private static function getLinks($post_content = '', $type = '') {
  
    $links_total = 0;
    $links_internal = 0;
    $links_external = 0;
  
    preg_match_all('/<a.*?href="(.*?)".*?<\/a>/', $post_content, $links);
    
    if (isset($links[1]) && is_array($links[1])) {

      $links = $links[1];

      foreach ($links as $link) {
        $link_type = self::getLinkType($link);
        
        if ($link_type == 'internal') {
          $links_internal++;
        } elseif ($link_type == 'external') {
          $links_external++;
        }
        
      }
      
    }

    if ($type == 'internal') {
      $links_total = $links_internal;
    } elseif ($type == 'external') {
      $links_total = $links_external;
    }

    return $links_total;
  
  }

  private static function getLinkType($link = '') {

    $site_url = get_site_url();    
    $link_type = '';
    
    if (self::startsWith($link, $site_url) || self::startsWith('/', $site_url) || self::startsWith('#', $site_url)) {
      $link_type = 'internal';
    } else {
      $link_type = 'external';
    }
    
    return $link_type;
  
  }
  
  private static function startsWith($haystack, $needle) {
    $length = strlen($needle);
    return substr($haystack, 0, $length) === $needle;
  }

}
