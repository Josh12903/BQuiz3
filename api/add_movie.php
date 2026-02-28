<?php include_once "db.php";

if(!empty($_FILES['tes']['tmp_name'])){
    move_uploaded_file($_FILES['tes']['tmp_name'],"../pic/".$_FILES['tes']['name']);
    $_POST['tes']=$_FILES['tes']['name'];
}

if(!empty($_FILES['poster']['tmp_name'])){
    move_uploaded_file($_FILES['poster']['tmp_name'],"../pic/".$_FILES['poster']['name']);
    $_POST['poster']=$_FILES['poster']['name'];
}

$_POST['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
unset($_POST['year'],$_POST['month'],$_POST['day']);


$_POST['sh']=1;
$_POST['rank']=$Movie->max("id")+1;

$Movie->save($_POST);

to("../admin.php?do=movie");

?>