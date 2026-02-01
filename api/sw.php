<?php include_once "db.php";
$db=${$_POST['table']};

$row1=$db->find($_POST['ids'][0]);
$row2=$db->find($_POST['ids'][1]);


$tmp=$poster1['rank'];
$row1['rank']=$row2['rank'];
$row2['rank']=$tmp;

$db->save($row1);
$db->save($row2);

// print_r($_POST);