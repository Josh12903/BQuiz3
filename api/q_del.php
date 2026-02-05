<?php include_once "db.php";

// $_POST['type'];
// $_POST['value'];

$Order->del([$_POST['type']=>$_POST['value']]);