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
          'templates/handlebars' => html(Kirby\Http\Remote::get($m.'templates/handlebars.php')->content()),
          'templates/render-unto' => html(Kirby\Http\Remote::get($m.'templates/render-unto.hbs')->content()),
          'controllers/handlebars' => html(Kirby\Http\Remote::get($m.'controllers/handlebars.php')->content()),
        ];
    }); ?>

    <h1><?= $page->title()->html() ?></h1>

    <h2>site/controllers/handlebars.php</h2>
    <pre><code data-language="php"><?= $github['controllers/handlebars'] ?></code></pre>

    <h2>site/template/render-unto.hbs</h2>
    <pre><code data-language="php"><?= $github['templates/render-unto'] ?></code></pre>

    <h2>site/templates/handlebars.php</h2>
    <pre><code data-language="php"><?= $github['templates/handlebars'] ?></code></pre>

    <h2>pageMethod</h2>
    <blockquote><?php
      // template 'render-unto'
      // data from site/controllers/home.php merged with custom array
      echo $page->handlebars('render-unto', ['g'=>'Gods']); ?>
    </blockquote>

    <h2>hbs helper</h2>
    <blockquote>
      <?php hbs('render-unto', ['c' => 'Caesar', 'g' => 'God']) ?>
    </blockquote>

    <?php snippet('footer') ?>
  </body>
</html>

