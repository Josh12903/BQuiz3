<?php include_once "db.php";

$_POST['movie']=$Movie->find($_POST['movie'])['name'];
// $_POST['date'] 當天 不用改;
$_POST['session']=$duration[$_POST['session']];
$_POST['no']=date("Ymd").sprintf("%04d",$Order->max('id')+1);
$_POST['qt']=count($_POST['seats']);

sort($_POST['seats']);
$_POST['seats']=serialize($_POST['seats']);

$Order->save($_POST);

?>
<style>
    #result-table{
        width: 500px;
        padding:20px;
        /* border-collapse:collapse; */
        border:1px solid #999;
        margin: auto;
    }


    #result-table td{
    border:1px solid #999;
    padding:20px;
}

#result-table td:nth-child(1){
    width: 20px;
}
#result-table tr:nth-child(odd){
    background:#eee;

}
</style>
<table id='result-table'>
    <tr>
        <td colspan='2'>感謝您的訂購，您的訂單編號是：<?=$_POST['no'];?></td>
        <td></td>
    </tr>
    <tr>
        <td>電影名稱：</td>
        <td><?=$_POST['movie'];?></td>
    </tr>
    <tr>
        <td>日期：</td>
        <td><?=$_POST['date'];?></td>
    </tr>
    <tr>
        <td>場次時間：</td>
        <td><?=$_POST['session'];?></td>
    </tr>
    <tr>
        <td colspan='2'>
            座位：
            <?php
            $_POST['seats']=unserialize($_POST['seats']);
            foreach($_POST['seats'] as $seat){
                echo "<div>";
                echo floor($seat/5)+1;
                echo "排";
                echo $seat%5 +1 ;
                echo "號";
                echo "</div>";
            }
            ?>

            <div>共<?=$_POST['qt'];?>張電影票</div>
        </td>
        <td></td>
    </tr>
    <tr>
        <td colspan='2'>
            <button onclick="location.href='index.php'"></button>
        </td>
        <td></td>
    </tr>
</table>