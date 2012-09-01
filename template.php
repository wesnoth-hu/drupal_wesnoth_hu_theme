<?php
// $Id: template.php,v 1.13 2008/05/13 09:19:13 johnalbin Exp $

/**
 * @file
 *
 * OVERRIDING THEME FUNCTIONS
 *
 * The Drupal theme system uses special theme functions to generate HTML output
 * automatically. Often we wish to customize this HTML output. To do this, we
 * have to override the theme function. You have to first find the theme
 * function that generates the output, and then "catch" it and modify it here.
 * The easiest way to do it is to copy the original function in its entirety and
 * paste it here, changing the prefix from theme_ to wesnoth_hu_theme_. For example:
 *
 *   original: theme_breadcrumb()
 *   theme override: wesnoth_hu_theme_breadcrumb()
 *
 * where wesnoth_hu_theme is the name of your sub-theme. For example, the zen_classic
 * theme would define a zen_classic_breadcrumb() function.
 *
 * If you would like to override any of the theme functions used in Zen core,
 * you should first look at how Zen core implements those functions:
 *   theme_breadcrumbs()      in zen/template.php
 *   theme_menu_item_link()   in zen/template-menus.php
 *   theme_menu_local_tasks() in zen/template-menus.php
 */

/*
 * Add any conditional stylesheets you will need for this sub-theme.
 *
 * To add stylesheets that ALWAYS need to be included, you should add them to
 * your .info file instead. Only use this section if you are including
 * stylesheets based on certain conditions.
 */

/* -- Delete this line if you want to use and modify this code
// Example: optionally add a fixed width CSS file.
if (theme_get_setting('wesnoth_hu_theme_fixed')) {
  drupal_add_css(path_to_theme() . '/layout-fixed.css', 'theme', 'all');
}
// */

/**
 * Implementation of HOOK_theme().
 */
function wesnoth_hu_theme_theme(&$existing, $type, $theme, $path) {

  // insert a large indexed value, so advanced_forum_theme_register_alter can't override it
  $existing['forum_list']['theme paths'][99] = 'sites/all/themes/wesnoth_hu_theme/templates/';
  $existing['forum_icon']['theme paths'][99] = 'sites/all/themes/wesnoth_hu_theme/templates/';
  $existing['forum_topic_list']['theme paths'][99] = 'sites/all/themes/wesnoth_hu_theme/templates/';
  $existing['comment_wrapper']['theme paths'][99] = 'sites/all/themes/wesnoth_hu_theme/templates/';

  return zen_theme($existing, $type, $theme, $path);
}

/**
 * Override or insert PHPTemplate variables into all templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 * @param $hook
 *   The name of the theme function being called (name of the .tpl.php file.)
 */
// /* -- Delete this line if you want to use this function
function wesnoth_hu_theme_preprocess(&$vars, $hook) {
  global $theme_key;
  $path_to_theme = drupal_get_path('theme', $theme_key);

  //print '<pre>';
  if($hook == 'forum_list'){
    /*
    print '<pre>';
    print_r($vars);
    exit();
    // */
    //$vars['template_files'][0] = '/templates/advf-forum-list';
  }
}
// */

/**
 * The rel="nofollow" attribute is missing from anonymous users' URL in Drupal 6.0-6.2.
 */
///* -- Delete this line if you want to use this function
function wesnoth_hu_theme_username($object) {

  if ($object->uid && $object->name) {
    // Shorten the name when it is too long or it will break many tables.
    if (drupal_strlen($object->name) > 20) {
      $name = drupal_substr($object->name, 0, 15) . '...';
    }
    else {
      $name = $object->name;
    }

    if (user_access('access user profiles')) {
      $output = l($name, 'user/' . $object->uid, array('attributes' => array('title' => t('View user profile.'))));
    }
    else {
      $output = check_plain($name);
    }
  }
  else if ($object->name) {
    // Sometimes modules display content composed by people who are
    // not registered members of the site (e.g. mailing list or news
    // aggregator modules). This clause enables modules to display
    // the true author of the content.
    if (!empty($object->homepage)) {
      $output = l($object->name, $object->homepage, array('attributes' => array('rel' => 'nofollow')));
    }
    else {
      $output = check_plain($object->name);
    }

    $output .= ' (' . t('not verified') . ')';
  }
  else {
    $output = variable_get('anonymous', t('Anonymous'));
  }

  return $output;
}
// */

/**
 * Return a multidimensional array of links for a navigation menu.
 *
 * @param $menu_name
 *   The name of the menu.
 * @param $level
 *   Optional, the depth of the menu to be returned.
 * @return
 *   An array of links of the specified menu and level.
 */
function wesnoth_hu_theme_navigation_links($menu_name, $level = 0) {
  // Don't even bother querying the menu table if no menu is specified.
  if (empty($menu_name)) {
    return array();
  }

  // Get the menu hierarchy for the current page.
  $tree_page = menu_tree_page_data($menu_name);
  // Also get the full menu hierarchy.
  $tree_all = menu_tree_all_data($menu_name);

  // Go down the active trail until the right level is reached.
  while ($level-- > 0 && $tree_page) {
    // Loop through the current level's items until we find one that is in trail.
    while ($item = array_shift($tree_page)) {
      if ($item['link']['in_active_trail']) {
        // If the item is in the active trail, we continue in the subtree.
        $tree_page = empty($item['below']) ? array() : $item['below'];
        break;
      }
    }
  }
  return wesnoth_hu_theme_navigation_links_level($tree_page, $tree_all);
}


/**
 * Helper function for wesnoth_hu_theme_navigation_links to recursively create an array of links.
 * (Both trees are required in order to include every menu item and active trail info.)
 */
function wesnoth_hu_theme_navigation_links_level($tree_page, $tree_all) {
  $links = array();
  foreach ($tree_all as $key => $item) {
    $item_page = $tree_page[$key];
    $item_all = $tree_all[$key];
    if (!$item_all['link']['hidden']) {
    	$class = '';
      $l = $item_all['link']['localized_options'];
      $l['href'] = $item_all['link']['href'];
      $l['title'] = $item_all['link']['title'];
      if ($item_page['link']['in_active_trail']) {
      	$class = ' active-trail';
      }
      if ($item_all['below']) {
        $l['children'] = wesnoth_hu_theme_navigation_links_level($item_page['below'], $item_all['below']);
      }
      // Keyed with the unique mlid to generate classes in theme_links().
      $links['menu-'. $item_all['link']['mlid'] . $class] = $l;
    }
  }
  return $links;
}


/**
 * Helper function to retrieve the primary links using wesnoth_hu_theme_navigation_links().
 */
function wesnoth_hu_theme_primary_links() {
  return wesnoth_hu_theme_navigation_links(variable_get('menu_primary_links_source', 'primary-links'));
}


/**
 * Return a themed set of links. (Extended to support multidimensional arrays of links.) 
 *
 * @param $links
 *   A keyed array of links to be themed.
 * @param $attributes
 *   A keyed array of attributes
 * @return
 *   A string containing an unordered list of links.
 */
function wesnoth_hu_theme_links($links, $attributes = array('class' => 'links')) {
  $output = '';

  if (count($links) > 0) {
    $output = '<ul'. drupal_attributes($attributes) .'>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = $key;

      // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $class .= ' first';
      }
      if ($i == $num_links) {
        $class .= ' last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))) {
        $class .= ' active';
      }
      // Added: if the link has child items, add a haschildren class
      if (isset($link['children'])) {
        $class .= ' haschildren';
      }
      $output .= '<li'. drupal_attributes(array('class' => $class)) .'>';

      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
        $output .= l($link['title'], $link['href'], $link);
      }
      else if (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span'. $span_attributes .'>'. $link['title'] .'</span>';
      }
      
      // Added: if the link has child items, print them out recursively
      if (isset($link['children'])) {
        $output .= "\n" . theme('links', $link['children'], array('class' =>'sublinks'));
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }
  return $output;
}

/**
 * Calculates the number of unread replies for each forum and returns the
 * count for the requested forum.
 */
function wesnoth_hu_theme_unread_comments_in_forum($tid, $uid) {
  static $result_cache = NULL;
  $r = 0;

  if (is_NULL($result_cache)) {
    $result_cache = array();

    $sql = "SELECT COUNT(c.cid) AS count, f.tid, t.parent
            FROM {comments} c
            INNER JOIN {forum} f ON c.nid = f.nid
            INNER JOIN {node} n ON f.vid = n.vid
            INNER JOIN {term_hierarchy} t ON t.tid = f.tid
            LEFT JOIN {history} h ON c.nid = h.nid AND h.uid = %d
            WHERE c.status = 0 AND c.timestamp > %d AND (c.timestamp > h.timestamp OR h.timestamp IS NULL)
            GROUP BY f.tid";

    $sql = db_rewrite_sql($sql, 'c', 'cid');

    $result = db_query($sql, $uid, NODE_NEW_LIMIT);
    while ($row = db_fetch_array($result)) {
      $result_cache[$row['tid']] = $row['count'];
      if($row['parent'] > 0){
        // ha van szülője, akkor a szülőnek is könyveljük el
        $result_cache[$row['parent']] += $row['count'];
      }
    }
  }

  if(isset($result_cache[$tid])) $r = $result_cache[$tid];
  return $r;
}
