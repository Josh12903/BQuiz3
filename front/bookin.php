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
        echo "<div class='seat null'>";
        // echo "<div class='seat booked'>";
        echo (floor($i/5)+1)."排". ($i%5 +1)."號";

        echo "<input type='checkbox' value='$i' class='chk'>"
        echo "</div>";
    }
    ?>
</div>

開始劃位
<!-- page -->
<button class="prev-step">上一步</button>
<button class="order-btn">訂購</button>