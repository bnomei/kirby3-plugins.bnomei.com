<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?>
>
  <head><?php snippet('plugin-htmlhead') ?></head>

  <body>
  <?php
    $github = lapse(md5($page->id()), function() {
      $m = 'https://raw.githubusercontent.com/bnomei/kirby3-plugins.bnomei.com/master/site/';
      return [
        'config/config.kirby3-plugins.bnomei.com' => html(Kirby\Http\Remote::get(
            $m.'config/config.kirby3-plugins.bnomei.com.php'
          )->content()),
        'templates/cloudconvert' => html(Kirby\Http\Remote::get(
          $m.'templates/cloudconvert.php'
        )->content()),
      ];
    }); ?>

  <h1><?= $page->title()->html() ?></h1>

  <h2>site/config/config.kirby3-plugins.bnomei.com.php</h2>
  <pre><code data-language="php"><?= $github['config/config.kirby3-plugins.bnomei.com'] ?></code></pre>

  <h2>site/templates/cloudconvert.php</h2>
  <pre><code data-language="php"><?= $github['templates/cloudconvert'] ?></code></pre>

  <h2>synchronously docx to pdf</h2>
  <blockquote>
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
  </blockquote>

  <h2>asynchronously jpg to webp</h2>
  <blockquote>
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
  </blockquote>

  <?php snippet('footer') ?>
</body>
</html>