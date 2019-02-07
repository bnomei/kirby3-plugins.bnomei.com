
<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?>>
  <head>
    <?php snippet('plugin-htmlhead') ?>

    <!-- css/js helper-->
    <?= Bnomei\Fingerprint::css('/assets/css/app.css') ?>
    <?= Bnomei\Fingerprint::js('/assets/js/app.js') ?>

    <!-- local SRI -->
    <?= Bnomei\Fingerprint::js(
      '/assets/js/app.js',
      [
        "integrity" => true
      ]
    );
    ?>

    <!-- external SRI -->
    <?= Bnomei\Fingerprint::js(
      'https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.js',
      [
        "integrity" => "sha256-U+vPaw6wGRNjtBRznIBWHgpzNvNI8pRs8fQC313cxfs"
      ]
    );
    ?>
  </head>
  <body>

    <h1><?= $page->title()->html() ?></h1>

    <h2>site/templates/fingerprint.php</h2>
    <pre><code data-language="php"><?=
        lapse(md5($page->id()), function() {
          $m = 'https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/';
          return html(Kirby\Http\Remote::get($m.'templates/fingerprint.php')->content());
        }); ?></code></pre>

    <h2>fingerprint</h2>
    <blockquote>
      <?= $page->file('flowers.jpg')->fingerprint() ?>
    </blockquote>

    <h2>integrity</h2>
    <blockquote>
      <?= $page->file('flowers.jpg')->integrity() ?>
    </blockquote>

    <?php snippet('footer') ?>
  </body>
</html>
