<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?>>
<?php snippet('plugin-htmlhead') ?>
<body>
  <?= $page->text()->kirbytext() ?>
  <ul>
    <?php foreach ($site->pages() as $plugin):
      if (in_array($plugin->intendedTemplate(), ['home', 'error'])) {
          continue;
      }
      ?>
    <li><a href="<?= $plugin->url() ?>"><?= $plugin->title()->html() ?></a></li>
    <?php endforeach; ?>
  </ul>
</body>
</html>