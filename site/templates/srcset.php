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
      return html(Kirby\Http\Remote::get('https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/templates/srcset.php')->content());
    }); ?></code></pre>

<b>PHP</b><br>
<?php
echo $page->image('flowers.jpg')->html();
echo $page->image('flowers.jpg')->srcset(); // aka ->srcset('default')
// 'breakpoints' is from default presets array. see...
// https://github.com/bnomei/kirby3-srcset/blob/master/index.php#L11
echo $page->image('flowers.jpg')->srcset('breakpoints');
?>

<hr>
<b>Kirbytag</b><br>
<?php
echo $page->text()->kirbytext();
?>
</body>
</html>