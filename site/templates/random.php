<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?>>
<head><?php snippet('plugin-htmlhead') ?></head>
<body>
<pre><code><?=
    lapse(md5($page->id()), function() {
      return html(Kirby\Http\Remote::get('https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/templates/random.php')->content());
    }); ?></code></pre>
<p>
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
</p>
<?php
// LOREM
echo $page->random('lorem', 'paragraphs', 3);
?>
<p>
  <?php
  // Token: upper, lower, numbers
  echo $page->random('token', 'lower,numbers', 5).'<br>'; // d63jd
  echo $page->random('token', 'lower,upper', 5).'<br>'; // GjHoL
  ?>
</p>
</body>
</html>