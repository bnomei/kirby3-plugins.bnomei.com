<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?> xmlns="http://www.w3.org/1999/html">

  <head><?php snippet('plugin-htmlhead') ?></head>

  <body>

    <h1><?= $page->title()->html() ?></h1>

    <h2>site/templates/robots-txt.php</h2>
    <pre><code data-language="php"><?=
        lapse(md5($page->id()), function() {
          $m = 'https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/';
          return html(Kirby\Http\Remote::get($m.'templates/robots-txt.php')->content());
        }); ?></code></pre>

    <h2>robots.txt <?= Kirby\Toolkit\Html::a(url('robots.txt'), 'open') ?></h2>
    <pre><code data-language="none"><?= Kirby\Http\Remote::get(url('robots.txt'))->content() ?></code></pre>
  </body>
</html>