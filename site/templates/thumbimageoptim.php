<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?>>
<head><?php snippet('plugin-htmlhead') ?></head>
<body>
<pre><code><?=
    lapse(md5($page->id()), function() {
      return html(Kirby\Http\Remote::get('https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/templates/thumbimageoptim.php')->content());
    }); ?></code></pre>

<?= $page->image('flowers.jpg')->html() ?>

<?= $page->image('flowers.jpg')->resize() ?>
<?php for($r = 800; $r >= 100; $r -= 100) {
  echo $page->image('flowers.jpg')->resize($r);
} ?>

</body>
</html>
