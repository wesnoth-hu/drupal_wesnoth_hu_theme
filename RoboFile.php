<?php
/**
 * Theme for the Hungarian Wesnoth Portal
 *
 * @see http://robo.li/
 */

class RoboFile extends \Robo\Tasks
{

  /**
   * Main build step, included to be compatible with Sage gulp
   */
  public function build() {
    $this->styles();
  }

  /** 
   * Concat the SCSS files and compile them to CSS
   */
  public function styles() {
    $this->taskScss(
      [
        '_src_/css/wesnoth_hu.scss' => 'wesnoth_hu.css'
      ]
    )
    ->addImportPath('_src_/css')
    ->setFormatter('Leafo\ScssPhp\Formatter\Compressed')
    ->run();
  }

  /** 
   * Watch the changes in the styles folder and recompile
   */
  public function watch() {
    $this->taskWatch()
      ->monitor('_src_/css', function() {
        $this->styles();
      })
      ->run();
  }
}
