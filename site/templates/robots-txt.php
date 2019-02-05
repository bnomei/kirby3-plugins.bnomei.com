<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html>
<?php snippet('html-head') ?>
<body>
<?= Kirby\Toolkit\Html::a(url('robots.txt'), 'robots.txt') ?>
<pre><code><?= Kirby\Http\Remote::get(url('robots.txt'))->content() ?></code></pre>
</body>
</html>