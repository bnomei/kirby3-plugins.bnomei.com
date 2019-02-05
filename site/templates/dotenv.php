<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html>
<?php snippet('html-head') ?>
<body>
<pre><code><?= html(Kirby\Http\Remote::get('https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/templates/dotenv.php')->content()) ?></code></pre>
<?= env('HELLO_DOTENV') ?>
</body>
</html>