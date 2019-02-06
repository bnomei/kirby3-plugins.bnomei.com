<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?>>
<?php snippet('plugin-htmlhead') ?>
<body>
<pre><code><?=
  lapse(md5($page->id()), function() {
    return html(Kirby\Http\Remote::get('https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/templates/default.php')->content());
  }); ?></code></pre>
</body>
</html>