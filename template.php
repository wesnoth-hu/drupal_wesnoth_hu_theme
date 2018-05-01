<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */


/**
 * Override or insert variables into the maintenance page template.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function wesnoth_hu_theme_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  STARTERKIT_preprocess_html($variables, $hook);
  STARTERKIT_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function wesnoth_hu_theme_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  $variables['classes_array'] = array_diff($variables['classes_array'],
    array('class-to-remove')
  );
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function wesnoth_hu_theme_preprocess_page(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function wesnoth_hu_theme_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--no-wrapper.tpl.php template for sidebars.
  if (strpos($variables['region'], 'sidebar_') === 0) {
    $variables['theme_hook_suggestions'] = array_diff(
      $variables['theme_hook_suggestions'], array('region__no_wrapper')
    );
  }
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function wesnoth_hu_theme_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  if ($variables['block_html_id'] == 'block-system-main') {
    $variables['theme_hook_suggestions'] = array_diff(
      $variables['theme_hook_suggestions'], array('block__no_wrapper')
    );
  }
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function wesnoth_hu_theme_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // STARTERKIT_preprocess_node_page() or STARTERKIT_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function wesnoth_hu_theme_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Implementation of HOOK_theme().
 */
/*
function wesnoth_hu_theme_theme(&$existing, $type, $theme, $path) {

  // insert a large indexed value, so advanced_forum_theme_register_alter can't override it
  $existing['forum_list']['theme paths'][99] = 'sites/all/themes/wesnoth_hu_theme/templates/';
  $existing['forum_icon']['theme paths'][99] = 'sites/all/themes/wesnoth_hu_theme/templates/';
  $existing['forum_topic_list']['theme paths'][99] = 'sites/all/themes/wesnoth_hu_theme/templates/';
  $existing['comment_wrapper']['theme paths'][99] = 'sites/all/themes/wesnoth_hu_theme/templates/';
  $existing['author_pane']['theme paths'][99] = 'sites/all/themes/wesnoth_hu_theme/templates/';

  return zen_theme($existing, $type, $theme, $path);
}
 */

/**
 * Override or insert PHPTemplate variables into all templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 * @param $hook
 *   The name of the theme function being called (name of the .tpl.php file.)
 */
// /* -- Delete this line if you want to use this function
/*
function wesnoth_hu_theme_preprocess(&$vars, $hook) {
  global $theme_key;
  $path_to_theme = drupal_get_path('theme', $theme_key);

  if($hook == 'comment'){
    // tegyük bele az osztályokba az online felhasználók kijelzését
    $timestamp = time() - 1800; // 3600s is one hour.
    $result = db_query('SELECT COUNT(*) FROM {sessions} WHERE uid = %d AND timestamp >= %d', $vars['account']->uid, $timestamp);
    $r = db_result($result);
    if( $r > 0 ) $vars['classes_array'][] = 'author-online';

    // user location
    $vars['location_user_location'] = $vars['account']->profile_user_from;
  }
}
// */

/**
 * The rel="nofollow" attribute is missing from anonymous users' URL in Drupal 6.0-6.2.
 */
///* -- Delete this line if you want to use this function
/*
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
/*
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
 */
