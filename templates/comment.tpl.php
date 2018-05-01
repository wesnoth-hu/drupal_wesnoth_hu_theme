<?php
/**
 * @file
 * Returns the HTML for comments.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728216
 */
?>
<div class="<?php print $classes; ?>"><div class="comment-inner clear-block">

  <?php if ($title): ?>
    <h3 class="title">
      <?php print $title; ?>
      <?php if ($comment->new): ?>
        <span class="new"><?php print $new; ?></span>
      <?php endif; ?>
    </h3>
  <?php elseif ($comment->new): ?>
    <div class="new"><?php print $new; ?></div>
  <?php endif; ?>

  <?php if ($unpublished): ?>
    <div class="unpublished"><?php print t('Unpublished'); ?></div>
  <?php endif; ?>

  <?php if ($picture) print $picture; ?>

  <div class="submitted">
    <?php print $submitted; ?>
  </div>

  <div class="content">
    <?php
      hide($content['links']);
      print render($content);
    ?>
    <?php if ($signature): ?>
    <hr />
    <div class="user-signature clear-block">
      <?php print $signature; ?>
    </div>
    <?php endif; ?>
  </div>

  <?php if ($links): ?>
    <div class="links">
      <?php print $links; ?>
    </div>
  <?php endif; ?>

</div></div> <!-- /comment-inner, /comment -->
