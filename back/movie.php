<!-- 院線片 管理 -->
<style>
    .movie-item {
        display: flex;
        align-items: center;
        margin-bottom:3px;
        background:#fff;
        padding:2px;
        width:95%;
        margin:auto;
    }
</style>
<button onclick="location.href='?do=add_movie'">新增電影</button>
<?php
$movies=$Movie->all(" order by `rank`");
foreach($movies as $movie):
?>
<div class="movie-item">
    <div style="width:80px">
        <img src="pic/<?=$movie['poster'];?>" style="width:70px;height:90px">
    </div>
    <div style="width:150px">
        分級：<img src="icon/03C0<?=$movie['level'];?>.png" alt="">
    </div>
    <div style="width:400px;flex:1">
        <div style="display: flex">
            <div style="width:33.3%">
                片名：<?=$movie['name'];?>
            </div>
            <div style="width:33.3%">
                片長：<?php
                echo floor($movie['length']/60);
                echo ":";
                echo $movie['length']%60;
                ?>
            </div>
            <div style="width:33.3%">
                上映時間：<?=$movie['ondate'];?>
            </div>
        </div>
        <div style="text-align:right">
            <button>顯示</button>
            <button>往上</button>
            <button>往下</button>
            <button onclick="location.href:'?do=edit_movie&id=<?=$movie['id'];?>'">編輯電影</button>
            <button onclick="location.href:'api/del_movie.php?id=<?$movie['id'];?>'">刪除電影</button>
        </div>
        <div>
            劇情簡介:<?=$movie['intro'];?>
        </div>
    </div>
</div>

<?php
endforeach;
?>