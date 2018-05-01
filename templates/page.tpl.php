<?php
/**
 * @file
 * Returns the HTML for a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728148
 */
?>

<div id="page"><div id="page-inner">

  <header class="header" role="banner"><div id="header-inner">

    <?php if ($logo || $site_name || $site_slogan): ?>
      <div id="logo-title">

        <?php if ($logo): ?>
          <div id="logo"><a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" id="logo-image" /></a></div>
        <?php endif; ?>

        <?php if ($site_name): ?>
          <?php if ($title): ?>
            <div id="site-name"><strong>
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
              <?php print $site_name; ?>
              </a>
            </strong></div>
          <?php else: ?>
            <h1 id="site-name">
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
              <?php print $site_name; ?>
              </a>
            </h1>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($site_slogan): ?>
          <div id="site-slogan"><?php print $site_slogan; ?></div>
        <?php endif; ?>

      </div> <!-- /#logo-title -->
    <?php endif; ?>

    <?php print render($page['header']); ?>

    <?php if ($main_menu): ?>
      <div id="menu" class="clear-block region">
        <?php print wesnoth_hu_theme_links(wesnoth_hu_theme_navigation_links('primary-links'))?>

        <?php print render($page['navigation']); ?>
      </div> <!-- /#menu -->

    <?php endif; ?>

  </div></header> <!-- /#header-inner, /#header -->

  <div id="main" class="layout-3col layout-swap"><div id="main-inner"><div id="main-section">

    <?php
      // Render the sidebars to see if there's anything in them.
      $sidebar_first  = render($page['sidebar_first']);
      $sidebar_second = render($page['sidebar_second']);
      // Decide on layout classes by checking if sidebars have content.
      $content_class = 'layout-3col__full';
      $sidebar_first_class = $sidebar_second_class = '';
      if ($sidebar_first && $sidebar_second):
        $content_class = 'layout-3col__right-content';
        $sidebar_first_class = 'layout-3col__first-left-sidebar';
        $sidebar_second_class = 'layout-3col__second-left-sidebar';
      elseif ($sidebar_second):
        $content_class = 'layout-3col__left-content';
        $sidebar_second_class = 'layout-3col__right-sidebar';
      elseif ($sidebar_first):
        $content_class = 'layout-3col__right-content';
        $sidebar_first_class = 'layout-3col__left-sidebar';
      endif;
    ?>

    <main class="<?php print $content_class; ?>">
      <div id="content"><div id="content-inner">

        <div id="content-top-img"><div id="content-top-img-inner"></div></div><!-- added for styling only -->

        <div id="content-inner2"><div id="content-inner3"><!-- added for proper background  styling -->

          <?php print render($page['highlighted']); ?>

          <?php print $breadcrumb; ?>
          <a href="#skip-link" class="visually-hidden visually-hidden--focusable" id="main-content">Back to top</a>
          <?php print render($title_prefix); ?>
          <?php if ($title): ?>
            <h1><?php print $title; ?></h1>
          <?php endif; ?>
          <?php print render($title_suffix); ?>
          <?php print $messages; ?>
          <?php print render($tabs); ?>
          <?php print render($page['help']); ?>
          <?php if ($action_links): ?>
            <ul class="action-links"><?php print render($action_links); ?></ul>
          <?php endif; ?>
          <?php print render($page['content']); ?>
          <?php print $feed_icons; ?>

          <?php if ($content_bottom): ?>
            <div id="content-bottom" class="region region-content_bottom">
              <?php print render($page['content_bottom']); ?>
            </div> <!-- /#content-bottom -->
          <?php endif; ?>

        </div></div> <!-- /#content-inner3, /content-inner2 -->

        <div id="content-bottom-img"><div id="content-bottom-img-inner"></div></div><!-- added for styling only -->

      </div></div> <!-- /#content-inner, /#content -->
    </main>

    <?php if ($sidebar_first): ?>
      <aside id="sidebar-left" class="<?php print $sidebar_first_class; ?>" role="complementary"><div id="sidebar-left-inner">
        <?php print $sidebar_first; ?>
      </div></aside>
    <?php endif; ?>

    <?php if ($sidebar_second): ?>
      <aside id="sidebar-right" class="<?php print $sidebar_second_class; ?>" role="complementary"><div id="sidebar-right-inner">
        <?php print $sidebar_second; ?>
      </div></aside>
    <?php endif; ?>

  </div></div></div> <!-- /.main-section, /#main-inner, /#main -->

  <footer id="footer"><div id="footer-inner">
    <?php print render($page['footer']); ?>
  </div></footer><!-- /#footer-inner, #footer -->

</div></div> <!-- /#page-inner, /#page -->

<?php print render($page['bottom']); ?>
