<?php include_once "../api/db.php";
$movie=$Movie->find($_GET['movieId']);

$sql=$Order->all(" WHERE movie='$movie['name']' && date='{$_GET['date']}' && session='{$duration[$_GET['session']]}'");
// dd($orders);

$seats=[];

foreach($orders as $order){
    $ordered_seats=unserialize($order['seats']);
    $seats=array_merge($seats,$ordered_seats);
}
// 陣列合併


// 完整座位表
// dd($seats);
?>
<style>
    #box{
        width: 540px;
        height: 370px;
        margin: auto;
        background-image:url('../icon/03D04.png');
        background-size:cover;
    
        padding-top:18px;
        box-sizing:border-box;
    }

    .seats{
        width:325px;
        height:348px;
        margin:auto;

        display:flex;
        flex-wrap:wrap;
    }
    .seat{
        width: 65px;
        height:87px;

        box-sizing:border-box;
        padding:3px;
        text-align: center;

        position:relative;
    }

    /* .seat:nth-child(odd){
        background:#FCF;
    } */

     .chk{
        position:absolute;

        bottom:5px;
        right:5px;
     }

     .booked{
        background-image:url('../icon/03D03.png');
        background-position:center;
        background-size:no-repeat;
     }
     .null{
        background-image:url('../icon/03D02.png');
        background-position:center;
        background-size:no-repeat;
     }
</style>

<div id="box"></div>
<div class="seats">
    <?php 
    for($i=0;$i<20;$i++){
        if(in_array($i,$seats)){

            echo "<div class='seat booked'>";
        }else{
            echo "<div class='seat null'>";
            
        }
        echo (floor($i/5)+1)."排". ($i%5 +1)."號";

        if(in_array($i,$seats)){

            echo "<input type='checkbox' value='$i' class='chk'>"
        }
        echo "</div>";
    }
    ?>
</div>

開始劃位
<div class="ct">
    <p>您選擇的電影是：<?=$movie['name'];?></p>
    <p>您選擇的時刻是：<?=$_GET['date'];?></p>
    <p>您已經勾選：<span id='tickets'></span>張票，最多可以購買四張票</p>
<!-- page -->
<button class="prev-step">上一步</button>
<button class="order-btn">訂購</button>
</div>

<script>

    let seats=new Array();
    $(".chk").on('click',function(){
        let seat=$(this).val();

            if($(this).prop('checked')){
                
                
                if(seats.length<4){
                    // 推進去
                    seats.push(seat)
                    // 改了幾張
                }else{
                    
                    alert("最多只能選四張票")
                    $(this).prop('checked',false)
                }
            }else{
                seats.splice(seats.indexOf(seat),1)
            }
            
            $("#tickets").text(seats,length)
        // console.log(seats)
    }) 
 

    $(".order-btn").on("click",function(){
        let movie=$("#movie").val();
        let date=$("#date").val();
        let session=$("#session").val();
        $.post(".api/order.php",{seat,movie,date,session},()=>{
            // console.log(seats,movie,date,session)

            // console.log(res)
                $("#orderResult").html(res)
            
            // order的
            $("#seat").hide();
            $("#orderForm").hide();
            $("#orderResult").hide();
        })
    })
</script>

<!-- 前端這裡做完 做後端api order -->