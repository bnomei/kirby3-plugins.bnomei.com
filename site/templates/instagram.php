<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html>
<?php snippet('html-head') ?>
<body>
<pre><code><?=
    lapse(md5($page->id()), function() {
      return html(Kirby\Http\Remote::get('https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/templates/instagram.php')->content());
    }); ?></code></pre>
<?php
  $token = env('INSTAGRAM_TOKEN'); // dotenv plugin
  foreach (site()->instagram($token) as $data) {
      echo Kirby\Toolkit\Html::img(
      $data['images']['standard_resolution']['url']
    );
  }
?>
</body>
</html>