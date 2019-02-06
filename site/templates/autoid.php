<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?>>
  <head><?php snippet('plugin-htmlhead') ?></head>
  <body>
    <h1><?= $page->title()->html() ?></h1>

    <h2>This is the time Kirby needs to build the index. Done only once per page refresh.</h2>

    <pre><code data-language="php">$page->index()->count()</code></PRE>
    <blockquote>
      <?php
      $t = round(microtime(true) * 1000);
      echo '<em>'.$page->index()->count().' pages</em> in index'.PHP_EOL;
      echo '<time>'.(round(microtime(true) * 1000)-$t).' ms</time> to call core kirby $page->index()';
      ?>
    </blockquote>

    <h2>Pages with AutoID and their cached Collection with modified()</h2>

    <pre><code data-language="php">// setup a semi-unique id for this group
$collectionID = "page('autoid')->index()";

// get cached collection, returns null if modified
$collection = modified($collectionID);

// if does not exist yet or was modified
if(!$collection) {
  $collection = modified($collectionID, page('autoid')->index());
  echo '=> Collection Cache: created or refreshed because modified.'.PHP_EOL;
} else {
  echo '=> Collection Cache: read.'.PHP_EOL;
}

foreach($collection as $p) {
  dump($p->url());
}
      </code></pre>

    <blockquote>
    <?php
      $collectionID = "page('autoid')->index()";
      $t = round(microtime(true) * 1000);
      $collection = modified($collectionID);
      echo '<time>'.(round(microtime(true) * 1000)-$t).' ms</time> to check modified.';
    ?>
      Even if Kirbys Page Index is not created yet this time measurement stays the same. It depends only on AutoIDs cache.<br><br>
    <?php
      $t = round(microtime(true) * 1000);
      if(!$collection) {
        $collection = modified($collectionID, page('autoid')->index());
        echo '=> Collection Cache: created or refreshed because modified.<br>';
      } else {
        echo '=> Collection Cache: read.<br>';
      }
      echo '<time>'.(round(microtime(true) * 1000)-$t).' ms</time> to create/refresh/read collection from cache.<br>';
      echo '<em>'.$collection->count().' pages</em> in collection';
    ?>
      <br><br>
      If created or refreshed: check modified time + kirby index + write collection cache time<br>
      If cached: check modified time + read cache time = about 1/4 of index + almost 0
    </blockquote>

    <h2>Usage autoid()</h2>

    <pre><code data-language="php">$page->content()->toArray();</code></pre>
    <blockquote><?php dump($page->content()->toArray()); ?></blockquote>

    <pre><code data-language="php">$page->autoid();</code></pre>
    <blockquote><?php dump($page->autoid()); ?></blockquote>

    <pre><code data-language="php">autoid($page->autoid())->url();</code></pre>
    <blockquote><?php dump(autoid($page->autoid())->url()); ?></blockquote>

    <pre><code data-language="php">autoid()->filterBy('autoid', $page->autoid())->first();</code></pre>
    <blockquote><?php dump(autoid()->filterBy('autoid', $page->autoid())->first()); ?></blockquote>

    <pre><code data-language="php">$randomFileID = autoid()->filterBy('type', 'file')->shuffle()->first()['autoid'];
$randomFile = autoid($anyAutoID);
dump($randomFile->url());
      </code></pre>
    <blockquote>
    <?php
      $randomFileID = autoid()->filterBy('type', 'file')->shuffle()->first()['autoid'];
      $t = round(microtime(true) * 1000);
      $randomFile = autoid($randomFileID);
      echo '<time>'.(round(microtime(true) * 1000)-$t).' ms</time> to find random file. duration does not depend on size of $page->index() only on count of items indexed.';
      dump($randomFile->url());
    ?>
    </blockquote>

    <pre><code data-language="php">$break = false;
foreach($page->index() as $pchi) {
  foreach($pchi->files() as $fi) {
    if($fi->id() == $randomFile->id()) {
      dump($randomFile->url());
      $break = true;
    }
    if($break) break;
  }
  if($break) break;
}
      </code></pre>
      <blockquote>
    <?php
    $t = round(microtime(true) * 1000);
    $break = false;
    foreach($page->index() as $pchi) {
      foreach($pchi->files() as $fi) {
        if($fi->id() == $randomFile->id()) {
          dump($randomFile->url());
          $break = true;
        }
        if($break) break;
      }
      if($break) break;
    }
    echo '<time>'.(round(microtime(true) * 1000)-$t).' ms</time> to find same file with foreach loops. duration <b>increases</b> with size of $page->index().';
    ?>
      <br>
      In addition to walking the for loops you would have to add the time to create the index (see top of page).
    </blockquote>

    <h2>Usage tinyurl()</h2>

    <?php
      $randomPageID = autoid()->filterBy('type', 'page')->shuffle()->first()['autoid'];
      $randomPage = autoid($randomPageID);
    ?>
    <pre><code data-language="php">$randomPage->autoid();</code></pre>
    <blockquote>
      <?php dump($randomPage->autoid()->value()); ?>
    </blockquote>

    <pre><code data-language="php">$randomPage->tinyurl();</code></pre>
    <blockquote>
      <a href="<?php echo $randomPage->tinyurl(); ?>"><?php echo $randomPage->uid(); ?></a>
    </blockquote>

    </pre>
  </body>
</html>