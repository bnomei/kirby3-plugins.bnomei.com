<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html>
<?php snippet('html-head') ?>
<body>
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