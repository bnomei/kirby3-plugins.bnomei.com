<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html>
<?php snippet('html-head') ?>
<body>
<pre><code><?= html(Kirby\Http\Remote::get('https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/templates/robots-txt.php')->content()) ?></code></pre>
<?= Kirby\Toolkit\Html::a(url('robots.txt'), 'robots.txt') ?>
<pre><code><?= Kirby\Http\Remote::get(url('robots.txt'))->content() ?></code></pre>
</body>
</html>