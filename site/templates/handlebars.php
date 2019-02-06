<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?>>
<?php snippet('plugin-htmlhead') ?>
<body>
<?php
  $github = lapse(md5($page->id()), function() {
    return [
      'templates/default' => html(Kirby\Http\Remote::get('https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/templates/default.php')->content()),
      'templates/render-unto' => html(Kirby\Http\Remote::get('https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/templates/render-unto.hbs')->content()),
      'controllers/handlebars' => html(Kirby\Http\Remote::get('https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/controllers/handlebars.php')->content()),
    ];
}); ?>
<pre><code><?= $github['templates/default'] ?></code></pre>

<b>site/template/render-unto.hbs</b>
<pre><code><?= $github['templates/render-unto'] ?></code></pre>

<b>site/controllers/handlebars.php</b>
<pre><code><?= $github['controllers/handlebars'] ?></code></pre>

<p><?php
  // template 'render-unto'
  // data from site/controllers/home.php merged with custom array
  echo $page->handlebars('render-unto', ['g'=>'Gods']); ?>
</p>
</body>
</html>

