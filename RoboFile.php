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
    // Do not use leafo/scssphp until all the chroma issues are fixed, eg.:
    // https://github.com/leafo/scssphp/issues/569
    /*
    $this->taskScss(
      [
        '_src_/css/wesnoth_hu.scss' => 'css/wesnoth_hu.css'
      ]
    )
    ->addImportPath('_src_/css')
    ->addImportPath('../zen/STARTERKIT/sass')
    ->addImportPath('vendor/bower-asset/breakpoint-sass/stylesheets')
    ->addImportPath('vendor/bower-asset/chroma/sass')
    ->addImportPath('vendor/bower-asset/support-for/sass')
    ->addImportPath('vendor/bower-asset/typey/stylesheets')
    ->addImportPath('vendor/bower-asset/zen-grids/sass')
    ->setFormatter('Leafo\ScssPhp\Formatter\Compressed')
    ->run();
     */
    // Use sass until leafo/scssphp can compile chroma
    $this->taskExec('sass')
      ->arg('--style=compressed')
      ->arg('--load-path=_src_/css')
      ->arg('--load-path=../zen/STARTERKIT/sass')
      ->arg('--load-path=vendor/bower-asset/breakpoint-sass/stylesheets')
      ->arg('--load-path=vendor/bower-asset/chroma/sass')
      ->arg('--load-path=vendor/bower-asset/support-for/sass')
      ->arg('--load-path=vendor/bower-asset/typey/stylesheets')
      ->arg('--load-path=vendor/bower-asset/zen-grids/sass')
      ->arg('_src_/css/wesnoth_hu.scss')
      ->arg('css/wesnoth_hu.css')
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
