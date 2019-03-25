<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?>>

  <head><?php snippet('plugin-htmlhead') ?></head>

  <body>
    <h1><?= $page->title()->html() ?></h1>

    <h2>site/templates/srcset.php</h2>
    <pre><code data-language="php"><?=
        lapse(md5($page->id()), function() {
          $m = 'https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/';
          return html(Kirby\Http\Remote::get($m.'templates/srcset.php')->content());
        }); ?></code></pre>

    <h2>PHP</h2>
    <blockquote>
    <?php
      echo $page->image('flowers.jpg')->html();
      echo $page->image('flowers.jpg')->imgElementWithSrcset(); // aka ->imgElementWithSrcset('default')
      // 'breakpoints' is from default presets array. see...
      // https://github.com/bnomei/kirby3-srcset/blob/master/index.php#L11
      echo $page->image('flowers.jpg')->imgElementWithSrcset('breakpoints');
    ?>
    </blockquote>

    <h2>Kirbytag</h2>
    <blockquote>
    <?php
      echo $page->text()->kirbytext();
    ?>
    </blockquote>

    <?php snippet('footer') ?>
  </body>
</html>
