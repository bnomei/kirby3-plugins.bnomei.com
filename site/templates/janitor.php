<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $page->title() . ' v' . kirby()->plugin('bnomei/janitor')->version() ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<pre>Check source in browsers dev tools.</pre>
<!-- e(class_exists('Bnomei\Janitor'), 'autoloader OK', 'autoloader FAILED'); -->
<!--
<?= e(class_exists('Bnomei\Janitor'), 'autoloader OK', 'autoloader FAILED').PHP_EOL; ?>
-->

<!-- dump(janitor('heist', true)); -->
<?php dump(janitor('heist', true)); ?>

</body>
</html>