<?php namespace ProcessWire; 
/**
 *  meta.php
 *  This is default meta info.
 *  File is included in head.php
 *  
 *  @var string $title
 *  @var string $description
 *  @var string $canonical
 *  @var string $generator
 *  
 * # Defaults
 *  Set defaults in _init.php setting() function.
 * 
 *  # Primary
 *  Set meta data in your template files in head() function. 
 *  This will have priority over defaults.
 *  @example
 *  head([
 *    "meta" => [
 *      "title" => "My Title",
 *      "description" => "My description..."
 *    ]
 *  ]);
 *  
 *  # Override
 *  If you want to use your own way to handle meta tags,
 *  you can create _meta.php file in the templates root: /tempaltes/_meta.php.
 *  _meta.php will be included insdead of /vendor/inc/meta.php
 *  
 */

$title = !empty($title) ? $title : $page->title;
$description = !empty($description) ? $description : false;
$canonical = !empty($canonical) ? $canonical : $page->httpUrl;
$image = !empty($image) ? $image : false;
$generator = !empty($generator) ? $generator : false;

?>

<?php // Primary Meta Tags ?>
<title><?= $title ?></title>
<?php if($description) :?>
<meta name="description" content="<?= $description ?>">
<?php endif; ?>
<link rel="canonical" href="<?= $canonical ?>">

<?php // Open Graph / Facebook ?>
<meta property="og:type" content="website">
<meta property="og:url" content="<?= $page->httpUrl ?>">
<meta property="og:title" content="<?= $title ?>">
<?php if($description) :?>
<meta property="og:description" content="<?= $description ?>">
<?php endif; ?>
<?php if($image) :?>
<?php // 1200×630 px ?>
<meta property="og:image" content="<?= $image ?>">
<?php endif;?>

<?php // Twitter ?>
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?= $page->httpUrl ?>">
<meta property="twitter:title" content="<?= $title ?>">
<?php if($description) :?>
<meta property="twitter:description" content="<?= $description ?>">
<?php endif; ?>
<?php if($image) :?>
<?php // aspect ratio 2:1 , min: 300x157 ?>
<meta property="twitter:image" content="<?= $image ?>">
<?php endif; ?>

<?php // hreflangs ;?>
<?php if(isset($languages) && $languages->count) :?>
<?php foreach($languages as $lang) :?>
<?php if($lang->name == "default") : ?>
<link rel="alternate" href="<?= $page->localHttpUrl($lang) ?>" hreflang="x-default">
<?php else : ?>
<link rel="alternate" href="<?= $page->localHttpUrl($lang) ?>" hreflang="<?= $lang->name ?>">
<?php endif;?>
<?php endforeach; ?>
<?php endif;?>

<?php if($generator) : ?>
<meta name="generator" content="<?= $generator ?>">
<?php endif;?>