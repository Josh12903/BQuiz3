<style>
/* 從瀏覽器 調好 丟過來 0126 15:09 看作法*/
.order-cols{
    display:flex;
    justify-content:space-between;
}
.order-cols > div{
    width: calc(100% / 7);
    text-align: center;
    background: #ddd;
    padding:3px 0;
}
.order-item{
    display:flex;
    justify-content:space-between;
    align-items: center;
}
.order-item > div{
    width: calc(100% - 7);
    padding: 3px 0;
    text-align: center;
}
.orders{
    height: 370px;
    overflow: auto;
}
</style>

<h3 class="ct">訂單管理</h3>

<div class="quick-del" style="display:felx">
    <div>快速刪除：</div>
    <div>
        <!-- type 互相存在變單選 -->
        <input type="radio" name="type" id="typeDate">依日期：
        <input type="text" name="date" id="date">
    </div>
    <div>
        <input type="radio" name="type" id="typeMovie">依電影：
        <input type="text" name="movie" id="movie">
    </div>
    <button style="margin:0 10px">刪除</button>
</div>


<div class="order-list" style="margin:5px">
    <div class="order-cols">
        <div>訂單編號</div>
        <div>電影名稱</div>
        <div>日期</div>
        <div>場次時間</div>
        <div>訂購數量</div>
        <div>訂購位置</div>
        <div>操作</div>
    </div>
    <div class="orders">
        <?php
        $orders=$Order->all(" order by no desc");
        foreach($orders as $order):
        ?>
        <div>
            <div><?=$order['no'];?></div>
            <div><?=$order['movie'];?></div>
            <div><?=$order['date'];?></div>
            <div><?=$order['session'];?></div>
            <div><?=$order['qt'];?></div>
            <div><?php
            $seats=unserialize($order['seats']);
            // $order['seats'];
            foreach($seats as $seat){
                echo "<div>";
                echo floor($seat/5)+1;
                echo "排";
                echo $seat/5 +1;
                echo "號";
                echo "</div>";
            }
            ?></div>
            
        </div>
        <div>
            <button>刪除</button>
        </div>
        <?php
        endforeach;
        ?>
    </div>
</div>
