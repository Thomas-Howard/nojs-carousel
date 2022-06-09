<?php
session_start();
//require_once("application/phpcarousel.php");
$sourceJSON = file_get_contents("data/source.json");
$decodedData = json_decode($sourceJSON, true);
$itemCount = count($decodedData);
$direction = 'unset';

if(isset($_GET['curr']) && is_numeric($_GET['curr'])) {
  $current = (int)$_GET['curr'];
  if($current < 1) {
    $current = 1;
  } else if($current > $itemCount) {
    $current = $itemCount;
  }
  $new = $current;
} else {
  $current = 1;
  $new = 1;
  $old = 1;
}

if(isset($_GET['dir'])) {
  $dirUnsafe = $_GET['dir'];
} else {
  $dirUnsafe = 'unset';
}

if($dirUnsafe == 'asc') {
  $new = $current+1;
  if($new > $itemCount) {
    $new = 1;
    $old = $itemCount;
  } else {
    $old =  $current;
  }
  $direction = 'asc';
}
else if($dirUnsafe == 'desc') {
  $new = $current-1;
  if($new < 1) {
    $new = $itemCount;
    $old = 1;
  } else {
    $old = $current;
  }
  $direction = 'desc';
}


$itemPair = array(
  'old' => $decodedData[$old-1],
  'new' => $decodedData[$new-1],
);
$debugstate = '';
if(isset($_GET['debug'])) {
  $debugstate = "&debug";
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>A Carousel with no JS</title>
  <link rel="icon" href="/favicon.svg" type="image/svg+xml">
  <link rel="stylesheet" href="css/styles.css">
  <style>
  <?php if(isset($_GET['debug'])) { ?>
    #carousel {
      overflow: visible;
    }
  <?php } ?>
  </style>
</head>

<body>
<?php if(isset($_GET['debug'])) { ?>
<p>Current: <?php echo $current;?></p>
<p>Old: <?php echo $old;?> <?php echo $old-1;?></p>
<p>New: <?php echo $new;?> <?php echo $new-1;?></p>
<?php } ?>

<div id='carousel' class='<?=$direction?>'> <?php
  foreach($itemPair as $key => $item) {     ?>
    <div id='item1' class='item <?=$key?>'>
      <img src="images/<?=$item['img']?>" alt='<?=$item['name']?>' title="<?=$item['name']?>" />
      <article>
        <h4><?=$item['name']?></h4>
        <p>Size: <?=$item['size']?> </p>
        <p>Tileset: <?=$item['tileset']?> </p>
      </article>
    </div><?php
  } ?>
</div>
<a href='/?dir=desc&curr=<?=(string)$new?><?=(string)$debugstate?>'><</a> | <a href='/?dir=asc&curr=<?=(string)$new?><?=(string)$debugstate?>'>></a>

</body>
</html>
