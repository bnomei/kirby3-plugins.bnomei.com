<?php
/** @var Kirby\Cms\App $kirby */
/** @var Kirby\Cms\Site $site */
/** @var Kirby\Cms\Page $page */
?><!DOCTYPE html>
<html <?= site()->attrLang() ?>>
<head>
  <?php snippet('plugin-htmlhead') ?>
  <style>
    code { display: block; background-color: #f2f2f2; padding: 1rem; font-weight: bold; }
    code.highlight { background-color: #fcfac2; font-size: 1.5rem; }
    * + code.highlight { margin-top: 2rem; }
    time { display: block; color: #4D80AD; }
    blockquote { margin: 1rem 0rem; padding: 1rem; background-color: #4D80AD; color: #fff; opacity: .7;}
  </style>
</head>
<body>
<pre>

<code class="highlight">Setup</code>

<?php /*
<code>snippet('create-child-pages', ['depth' => 3, 'childs' => 10])</code>
<?php 
$t = round(microtime(true) * 1000);
snippet('create-child-pages', ['depth' => 3, 'childs' => 10]);
echo '<time><b>'.(round(microtime(true) * 1000)-$t).'</b> ms to build subpages if needed</time>';
?>
*/ ?>

<code>$page->index()->count()</code>
<?php 
$t = round(microtime(true) * 1000);
echo $page->index()->count().' pages in index'.PHP_EOL; 
echo '<time><b>'.(round(microtime(true) * 1000)-$t).'</b> ms to call core kirby $page->index()</time>';
?>
<blockquote>This is the time Kirby needs to build the index. Done only once per page refresh.</blockquote>

<?php /*
<code>snippet('flush-cache')</code>
<?php 
$t = round(microtime(true) * 1000);
snippet('flush-cache');
echo '<time><b>'.(round(microtime(true) * 1000)-$t).'</b> ms to flush cache and rebuild autoid cache</time>';
?>
*/ ?>

<code class="highlight">Pages with AutoID and their cached Collection with modified()</code>

<code>// setup a semi-unique id for this group
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
</code>

<?php
$collectionID = "page('autoid')->index()";
$t = round(microtime(true) * 1000);
$collection = modified($collectionID);
echo '<time><b>'.(round(microtime(true) * 1000)-$t).'</b> ms to check modified</time>';
?>
<blockquote>Even if Kirbys Page Index is not created yet this time measurment stays the same. It depends only on AutoIDs cache.</blockquote>
<?php
$t = round(microtime(true) * 1000);
if(!$collection) {
  $collection = modified($collectionID, page('autoid')->index());
  echo '=> Collection Cache: created or refreshed because modified.'.PHP_EOL;
} else {
  echo '=> Collection Cache: read.'.PHP_EOL;
}
echo '<time><b>'.(round(microtime(true) * 1000)-$t).'</b> ms to create/refresh/read collection from cache</time>';
echo $collection->count().' pages in collection';
?>
<blockquote>
If created or refreshed: check modified time + kirby index + write collection cache time<br>
If cached: check modified time + read cache time = about 1/4 of index + almost 0
</blockquote>

<code class="highlight">Usage autoid()</code>

<code>$page->content()->toArray();</code>
<?php dump($page->content()->toArray()); ?>

<code>$page->autoid();</code>
<?php dump($page->autoid()); ?>

<code>autoid($page->autoid())->url();</code>
<?php dump(autoid($page->autoid())->url()); ?>

<code>autoid()->filterBy('autoid', $page->autoid())->first();</code>
<?php dump(autoid()->filterBy('autoid', $page->autoid())->first()); ?>

<code>$randomFileID = autoid()->filterBy('type', 'file')->shuffle()->first()['autoid'];
$randomFile = autoid($anyAutoID);
dump($randomFile->url());
</code>
<?php 
$randomFileID = autoid()->filterBy('type', 'file')->shuffle()->first()['autoid'];
$t = round(microtime(true) * 1000);
$randomFile = autoid($randomFileID);
echo '<time><b>'.(round(microtime(true) * 1000)-$t).'</b> ms to find random file. duration does not depend on size of $page->index() only on count of items indexed.</time>';
dump($randomFile->url());
?>

<code>$break = false;
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
</code>
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
echo '<time><b>'.(round(microtime(true) * 1000)-$t).'</b> ms to find same file with foreach loops. duration <b>increases</b> with size of $page->index().</time>';
?>
<blockquote>In addition to walking the for loops you would have to add the time to create the index (see top of page).</blockquote>

<?php /*
<code>dirToArray($page->root())</code>
<?php
if (!function_exists('dirToArray')) {
    function dirToArray($dir)
    {
        $result = array();

        $cdir = scandir($dir);
        foreach ($cdir as $key => $value) {
            if (!in_array($value, array(".",".."))) {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                    $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
                } else {
                    $result[] = $value;
                }
            }
        }
 
        return $result;
    }
}
dump(dirToArray($page->root()));
?>

<code>foreach(autoid() as $a) { dump($a); }</code>
<?php foreach(autoid() as $a) { dump($a); } ?>

*/
?>

<code class="highlight">Usage tinyurl()</code>

<?php 
$randomPageID = autoid()->filterBy('type', 'page')->shuffle()->first()['autoid']; 
$randomPage = autoid($randomPageID);
?>
<code>$randomPage->autoid();</code>
<?php dump($randomPage->autoid()->value()); ?>

<code>$randomPage->tinyurl();</code>
<a href="<?php echo $randomPage->tinyurl(); ?>"><?php echo $randomPage->uid(); ?></a>

</pre>
</body>
</html>