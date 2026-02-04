<?php include_once "db.php";

$movie=$Movie->find($_GET['movieId']);
$today=strtotime(date("Y-m-d"));

$ondate=strtotime($movie['ondate']);

$gap=floor(($today-$ondate)/(86400));



for($i=0;$i<(3-$gap);$i++){
    $diff=2-$i;
    $date=date("Y-m-d",strtotime("+$i days",$today));
    echo "<option value='$date'>";
    echo $date;
    echo "</option>"; 
}


