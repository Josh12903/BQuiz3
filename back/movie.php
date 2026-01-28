<!-- 院線片 管理 -->
<style>
    .movie-item {
        display: flex;
        align-item: center;
        margin-bottom:3px;
        background:#fff;
        padding:2px;
        width:95%;
        margin:auto;
    }
</style>
<button onclick="location.href='?do=add_movie'">新增電影</button>


<div class="movie-item">
    <div style="width:80px">
        <img src="." alt="">
    </div>
    <div style="width:150px">
        分級：<img src="." alt="">
    </div>
    <div style="width:400px;flex:1">
        <div style="display: flex">
            <div style="width:33.3%">
                片名：
            </div>
            <div style="width:33.3%">
                片長：
            </div>
            <div style="width:33.3%">
                上映時間：
            </div>
        </div>
        <div style="text-align:right">
            <button>顯示</button>
            <button>往上</button>
            <button>往下</button>
            <button>編輯電影</button>
            <button>刪除電影</button>
        </div>
        <div></div>
    </div>
</div>