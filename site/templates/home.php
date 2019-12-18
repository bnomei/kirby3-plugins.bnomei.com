<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?>>
<head><?php snippet('plugin-htmlhead') ?></head>
<body>
  <h1><?= $page->title()->html() ?></h1>
  <?= $page->text()->kirbytext() ?>

  <ul class="mb-12">
    <?php foreach ($site->pages() as $plugin):
      if (in_array($plugin->intendedTemplate(), ['home', 'error'])) {
          continue;
      }
      ?>
    <li><a href="<?= $plugin->url() ?>"><?= $plugin->title()->html() ?></a></li>
    <?php endforeach; ?>
  </ul>

  <h2>Issues & Code Quality</h2>
  <table class="table--readable mb-12">
    <thead>
      <tr>
        <td>Repository</td>
        <td>Release</td>
        <td>Stars</td>
        <td>Downloads</td>
        <td>Issues</td>
        <td>Build Status</td>
        <td>Coverage Status</td>
        <td>Maintainability</td>
      </tr>
    </thead>
    <tbody>
    <?php
    $plugins = [
      'autoid', 'lapse', 'security-headers', 'janitor', 'redis-cachedriver',
      'mailjet', 'stopwatch', 'ics', 'monolog', 'qrcode', 'feed', 'srcset',
      'fingerprint', 'field-ecco', 'cloudconvert', 'doctor', 'dotenv', 'instagram',
      'mobile-detect', 'random', 'redirects', 'robots-txt', 'htmlhead', 'handlebars',
      'thumb-imageoptim', 'csv',
      // 'calendar',
      // 'digitalocean-spaces-cdn',
    ];
    sort($plugins);

    foreach ($plugins as $plugin): ?>
    <tr>
      <td><a href="https://github.com/bnomei/kirby3-<?= $plugin ?>">kirby3-<?= $plugin ?></a></td>
      <td><img src="https://flat.badgen.net/packagist/v/bnomei/kirby3-<?= $plugin ?>?color=ae81ff"></td>
      <td><img src="https://flat.badgen.net/packagist/ghs/bnomei/kirby3-<?= $plugin ?>?color=272822"></td>
      <td><img src="https://flat.badgen.net/packagist/dt/bnomei/kirby3-<?= $plugin ?>?color=272822"></td>
      <td><img src="https://flat.badgen.net/packagist/ghi/bnomei/kirby3-<?= $plugin ?>?color=e6db74"></td>
      <td><a href==https://travis-ci.com/bnomei/kirby3-<?= $plugin ?>"><img src="https://flat.badgen.net/travis/bnomei/kirby3-<?= $plugin ?>"></a></td>
      <td><a href==https://coveralls.io/github/bnomei/kirby3-<?= $plugin ?>"><img src="https://flat.badgen.net/coveralls/c/github/bnomei/kirby3-<?= $plugin ?>"></a></td>
      <td><a href==https://codeclimate.com/github/bnomei/kirby3-<?= $plugin ?>)"><img src="https://flat.badgen.net/codeclimate/maintainability/bnomei/kirby3-<?= $plugin ?>"></a></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>

  <?php snippet('footer') ?>
</body>
</html>
