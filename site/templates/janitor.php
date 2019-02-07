<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?>>

  <head><?php snippet('plugin-htmlhead') ?></head>

  <body>

    <?php
    $github = lapse(md5($page->id()), function() {
      $m = 'https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/';
      return [
        'blueprints/pages/janitor' => html(Kirby\Http\Remote::get(
          $m.'blueprints/pages/janitor.yml'
        )->content()),
        'templates/janitor' => html(Kirby\Http\Remote::get(
          $m.'templates/janitor.php'
        )->content()),
      ];
    }); ?>

    <h1><?= $page->title()->html() ?></h1>

    <h2>site/blueprints/pages/janitor.yml</h2>
    <pre><code data-language="html"><?= $github['blueprints/pages/janitor'] ?></code></pre>

    <h2>site/templates/janitor.php</h2>
    <pre><code data-language="php"><?= $github['templates/janitor'] ?></code></pre>

    <blockquote>
      <?php dump(janitor('heist', true)); ?>
    </blockquote>

    <?php snippet('footer') ?>
  </body>
</html>