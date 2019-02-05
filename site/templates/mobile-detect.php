<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html>
<?php snippet('html-head') ?>
<body>
<pre><code><?= html(Kirby\Http\Remote::get('https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/templates/mobile-detect.php')->content()) ?></code></pre>
<?php
$detect = $page->detect();
// https://github.com/serbanghita/Mobile-Detect/wiki/Code-examples
echo $detect->is('Chrome') ? 'Chrome' : 'Not Chrome';

if($page->isMobile()) {
  echo ' on mobile';
}
?>
</body>
</html>