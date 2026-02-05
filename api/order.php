<?php include_once "db.php";

$_POST['movie']=$Movie->find($_['movie']['name']);
// $_POST['date'] 當天 不用改;
$_POST['session']=$duration[$_POST['session']];
$_POST['no']=("Y-m-d").sprintf("%04d",$Order->max('id')+1);
$_POST['qt']=count($_POST['seats']);

sort($_POST['seats']);
$_POST['seats']=serialize($_POST['seats']);

$Order->save($_POST);

?>