<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?>>
  <head><?php snippet('plugin-htmlhead') ?></head>
  <body>

  <h1><?= $page->title()->html() ?></h1>

  <h2>site/templates/doctor.php</h2>
  <pre><code data-language="php"><?=
      lapse(md5($page->id()), function() {
        $m = 'https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/';
        return html(Kirby\Http\Remote::get($m.'site/templates/doctor.php')->content());
      }); ?></code></pre>

  </body>
</html>