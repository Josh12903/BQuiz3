<?php include_once "db.php";

if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../pic/".$_FILES['img']['name']);
    $_POST['img']=$_FILES['img']['name'];
    $_POST['sh']=1;
    $_POST['rank']=$Poster->max('id')+1;
    $_POST['ani']=rand(1,3);

    $Poster->save($_POST);
}

to("../admin.php?do=poster");