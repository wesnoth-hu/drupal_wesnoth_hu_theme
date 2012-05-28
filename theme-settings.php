<?php
// $Id: theme-settings.php,v 1.6 2008/05/13 09:19:13 johnalbin Exp $

/**
 * Implementation of THEMEHOOK_settings() function.
 *
 * @param $saved_settings
 *   An array of saved settings for this theme.
 * @return
 *   A form array.
 */
function wesnoth_hu_settings($saved_settings) {

  // Get the default values from the .info file.
  $themes = list_themes();
  $defaults = $themes['wesnoth_hu']->info['settings'];

  // Merge the saved variables and their default values.
  $settings = array_merge($defaults, $saved_settings);

  /*
   * Create the form using Forms API: http://api.drupal.org/api/6
   */
  $form = array();
  // -- Delete this line if you want to use this setting
  $form['subtheme_example'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Taxonómia feliratok látszanak'),
    '#default_value' => $settings['wesnoth_hu_taxonomy'],
    '#description'   => t("Lehetővé teszi a taxonómia feliratok eltüntetését."),
  );
  // */

  // Add the base theme's settings.
  include_once './' . drupal_get_path('theme', 'zen') . '/theme-settings.php';
  $form += zen_settings($saved_settings, $defaults);

  // Remove some of the base theme's settings.
  unset($form['themedev']['zen_layout']); // We don't need to select the base stylesheet.

  // Return the form
  return $form;
}
