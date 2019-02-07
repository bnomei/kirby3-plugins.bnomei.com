<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?>>

  <head><?php snippet('plugin-htmlhead') ?></head>

  <body>

    <h1><?= $page->title()->html() ?></h1>

    <h2>site/templates/dotenv.php</h2>
    <pre><code data-language="php"><?=
      lapse(md5($page->id()), function() {
        $m = 'https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/';
        return html(Kirby\Http\Remote::get($m.'templates/dotenv.php')->content());
      }); ?></code></pre>

    <h2>what did my .env say?</h2>
    <blockquote>
      <?= env('HELLO_DOTENV') ?>
    </blockquote>

    <?php snippet('footer') ?>
  </body>
</html>