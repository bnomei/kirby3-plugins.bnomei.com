<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?>>

  <head><?php snippet('plugin-htmlhead') ?></head>

  <body>

    <h1><?= $page->title()->html() ?></h1>

    <h2>site/templates/random.php</h2>
    <pre><code data-language="php"><?=
        lapse(md5($page->id()), function() {
          $m = 'https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/';
          return html(Kirby\Http\Remote::get($m.'templates/random.php')->content());
        }); ?></code></pre>

    <h2>string, number, pools</h2>
    <blockquote>
    <?php
      // STRING
      echo $page->random(23).'<br>';

      // NUMBER
      echo $page->random([41, 53], 'between').'<br>';

      // POOL
      // from a comma seperated string
      echo $page->random('red, green, blue, black, white, yellow', 'pool', 3).'<br>';
      // or a php array
      $myArray = ['red', 'green', 'blue'];
      echo $page->random($myArray, 'pool', 3).'<br>';
    ?>
    </blockquote>

    <h2>lorem ipsum</h2>
    <blockquote>
    <?php
      // LOREM
      echo $page->random('lorem', 'paragraphs', 3);
    ?>
    </blockquote>

    <h2>tokens</h2>
    <blockquote>
    <?php
      // Token: upper, lower, numbers
      echo $page->random('token', 'lower,numbers', 5).'<br>'; // d63jd
      echo $page->random('token', 'lower,upper', 5).'<br>'; // GjHoL
    ?>
    </blockquote>

    <?php snippet('footer') ?>
  </body>
</html>