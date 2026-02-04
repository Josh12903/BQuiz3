<div id="orderform">
<h3 class="ct">線上訂票</h3>

<style>
    #orderL{
        width: 300px;
        margin: auto;
        text-align: center;
        padding: 20px;
        background:#eee;
    }
</style>

<form>
<table id="orderL">
    <tr>
        <td>電影：</td>
        <td>
            <select name="movie" id="movie">
                <?php
                $today=date("Y-m-d");
                $ondate=date("Y-m-d",strtotime("-2 days"));

                $id=$_GET['id']??0;


                $movies=$Movie->all(" where `sh`=1 && `ondate` between '$ondate' AND '$today'");
                foreach($movies as $movie){

                    $selected=(!empty($id) && $id==$movie['id'])?"selected":"";

                    echo "<option value='{$movie['id']}' $selected>{$movie['name']}</option>";
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>日期：</td>
        <td>
            <select name="date" id="date"></select>
        </td>
    </tr>
    <tr>
        <td>場次</td>
        <td>
            <select name="session" id="session"></select>
        </td>
    </tr>
</table>
                <div class="ct">
                    <button class="send-order">確定</button>
                    <button type="reset">重置</button>
                </div>
</div>
</form>
<div id="seat" style="display:none">
    <button class="prev-step">上一步</button>
    <button class="order-btn">訂購</button>
</div>
<div id="orderResult" style="display:none"></div>
<script>


    $("#movie").on("change",function(){
        let movieId=$(this).val();
        selectDate(movieId);
    })

        selectDate(("#movie").val());

// 邏輯 分類再整理
$(".send-order").on("click",function(){
    $("#seat").show();
    $("#orderform").hide();
    $("#orderResult").hide();
})
$(".prev-order").on("click",function(){
    $("#seat").hide();
    $("#orderform").show();
    $("#orderResult").hide();
})
$(".order-btn").on("click",function(){
    $("#seat").hide();
    $("#orderform").show();
    $("#orderResult").show();
})

// $(".reset").on("click",function(){
//     $("#movie").val($("#movie option").eq(0).val());
// })

    function selectDate(movieId){
        $.get("api/get_date.php",{movieId},function(dates){
            $("#date").html(dates);
        })
    }


        function selectSession(){
            let movieId=$("#movie").val();
            let date=$("#date").val();
            $.get("api/get_sessions.php",{movieId,date},function(sessions){
                $("#session").html(sessions);
            })
        }
</script>