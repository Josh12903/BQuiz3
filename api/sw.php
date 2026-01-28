<?php include_once "db.php";

$poster1=$Poster->find($_POST['ids'][0]);
$poster2=$Poster->find($_POST['ids'][1]);


$tmp=$poster1['rank'];
$poster1['rank']=$poster2['rank'];
$poster2['rank']=$tmp;

$Poster->save($poster1);
$Poster->save($poster2);

// print_r($_POST);