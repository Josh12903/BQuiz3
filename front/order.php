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
                $movies=$Movie->all(" where `sh`=1 && `ondate` between '$ondate' AND '$today'");
                foreach($movies as $movie){
                    echo "<option value='{$movie['id']}'>{$movie['name']}</option>";
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