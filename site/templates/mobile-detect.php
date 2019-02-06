<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?>>

  <head><?php snippet('plugin-htmlhead') ?></head>

  <body>
    <h1><?= $page->title()->html() ?></h1>

    <h2>site/templates/mobile-detect.php</h2>
    <pre><code data-language="php"><?=
        lapse(md5($page->id()), function() {
          $m = 'https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/';
          return html(Kirby\Http\Remote::get($m.'templates/mobile-detect.php')->content());
        }); ?></code></pre>

    <h2>detecting...</h2>
    <blockquote>
    <?php
      // https://github.com/serbanghita/Mobile-Detect/wiki/Code-examples
      $detect = $page->detect();
      e($detect->isAndroidOS(), 'Android OS', 'Not Android OS');
      echo ', ';
      // pageMethod
      e($page->isMobile(), 'on mobile', 'not mobile')
    ?>
    </blockquote>
  </body>
</html>