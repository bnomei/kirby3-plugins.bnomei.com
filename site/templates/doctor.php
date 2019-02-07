<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?>>
  <head><?php snippet('plugin-htmlhead') ?></head>
  <body>

  <h1><?= $page->title()->html() ?></h1>

  <h2>site/blueprints/pages/doctor.yml</h2>
  <pre><code data-language="html"><?=
      lapse(md5($page->id()), function() {
        $m = 'https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/';
        return html(Kirby\Http\Remote::get($m.'blueprints/pages/doctor.yml')->content());
      }); ?></code></pre>

  <?php snippet('footer') ?>
  </body>
</html>