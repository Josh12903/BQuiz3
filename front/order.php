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


<script>
    $("#movie").on("change",function(){
        let movieId=$(this).val();
        selectDate(movieId);
    })

        selectDate(("#movie").val());

    function selectDate(movieId){
        $.get("api/get_date.php",{movieId},function(dates){
            $("#date").html(dates);
        })
    }
</script>