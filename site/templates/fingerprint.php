
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
<pre><code><?=
    lapse(md5($page->id()), function() {
      return html(Kirby\Http\Remote::get('https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/templates/fingerprint.php')->content());
    }); ?></code></pre>

<p><?= $page->file('flowers.jpg')->fingerprint() ?></p>
<p><?= $page->file('flowers.jpg')->integrity() ?></p>
</body>
</html>
