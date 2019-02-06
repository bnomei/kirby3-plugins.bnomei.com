<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?>>

  <head><?php snippet('plugin-htmlhead') ?></head>

  <body>

    <h1><?= $page->title()->html() ?></h1>

    <h2>site/templates/thumimageoptim.php</h2>
    <pre><code data-language="php"><?=
        lapse(md5($page->id()), function() {
          $m = 'https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/';
          return html(Kirby\Http\Remote::get($m.'templates/thumbimageoptim.php')->content());
        }); ?></code></pre>

    <h2>original</h2>
    <blockquote>
      <?= $page->image('flowers.jpg')->html() ?>
    </blockquote>

    <h2>original optimized</h2>
    <blockquote>
      <?= $page->image('flowers.jpg')->resize() ?>
    </blockquote>

    <h2>resized and optimized</h2>
    <blockquote>
      <?php for($r = 800; $r >= 100; $r -= 100) {
        echo $page->image('flowers.jpg')->resize($r);
      } ?>
    </blockquote>

  </body>
</html>
