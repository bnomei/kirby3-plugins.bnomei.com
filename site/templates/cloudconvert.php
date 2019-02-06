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
  return [
    'templates/cloudconvert' => html(Kirby\Http\Remote::get('https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/templates/cloudconvert.php')->content()),
    'config/config.kirby3-plugins.bnomei.com' => html(Kirby\Http\Remote::get('https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/config/config.kirby3-plugins.bnomei.com')->content()),
  ];
}); ?>
<pre><code><?= $github['templates/cloudconvert'] ?></code></pre>

<b>site/config/config.kirby3-plugins.bnomei.com.php</b>
<pre><code><?= $github['config/config.kirby3-plugins.bnomei.com'] ?></code></pre>

<p>
<b>synchronously docx to pdf</b><br>
<?php
if ($fileWord = $page->file('test.docx')) {
  $filePDF = $fileWord->cloudconvert(
    [
      'inputformat' => 'docx',
      'outputformat' => 'pdf',
    ],
    str_replace('.docx', '.pdf', $fileWord->root()),
    false // wait for conversion to be done
  );
  echo $fileWord->url().'<br>';
  if ($filePDF) {
    echo $filePDF->url().'<br>';
  }
}
?>
</p>

<p>
<b>asynchronously jpg to webp</b><br>
<?php
if ($fileJpg = $page->file('flowers.jpg')) {
  echo $fileJpg->url().'<br>';
  $process = $fileJpg->cloudconvert(
    [
      'inputformat' => 'jpg',
      'outputformat' => 'webp',
    ],
    str_replace('.jpg', '.webp', $fileJpg->root())
  // NOTICE: no 'false' here!
  );
}
// NOTICE: file might not exists immediately
if ($fileWebp = $page->file('flowers.webp')) {
  echo $fileWebp->url().'<br>';
} else {
  echo 'does not exist yet.<br>';
}
?>
</p>
</body>
</html>