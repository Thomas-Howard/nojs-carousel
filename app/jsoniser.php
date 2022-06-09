<?php

$itemList = array();
$itemList[] = array(
  "img" => "aramon-arena.jpg",
  "name" => "Aramon Arena",
  "size" => "33x12",
  "tileset" => "Aramon"
);

$itemList[] = array(
  "img" => "concordant-crossroads.jpg",
  "name" => "Concordant Crossroads",
  "size" => "37 x 37",
  "tileset" => "Veruna",
);


$itemList[] = array(
  "img" => "crosspaths-redux.jpg",
  "name" => "Crosspaths",
  "size" => "40 x 40",
  "tileset" => "Metal",
);

$itemList[] = array(
  "img" => "hairy-bogan.jpg",
  "name" => "Hairy Bogan",
  "size" => "32 x 32",
  "tileset" => "Zhon",
);

$itemList[] = array(
  "img" => "sharktopus.jpg",
  "name" => "Sharktopus",
  "size" => "41 x 41",
  "tileset" => "Metal",
);


echo json_encode($itemList,  JSON_PRETTY_PRINT);

?>
