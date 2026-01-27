<div>預告片清單</div>

<div style="display:flex;justify-content:space-between">
    <div class="ct" style="width:25%">預告片海報</div>
    <div class="ct" style="width:25%">預告片片名</div>
    <div class="ct" style="width:25%">預告片排序</div>
    <div class="ct" style="width:25%">操作</div>
</div>
<div style="height:300px;overflow:auto">
    <?php
    $posters=$Poster->all(" ORDER BY `rank` ASC");
    foreach($posters as $poster):
    ?>    
        <div style="display:flex;justify-content:space-between">
            <div class="ct" style="width:25%">
                <img src="./pic/<?=$poster['img'];?>" alt="">    
            預告片海報</div>
            <div class="ct" style="width:25%">預告片片名</div>
            <div class="ct" style="width:25%">預告片排序</div>
            <div class="ct" style="width:25%">操作</div>
        </div>

        <input type="submit" value="編輯確定">
        <input type="submit" value="重置">
    <?php
    endforeach;
    ?>
</div>







<hr>
<div>新增預告片海報</div>

<form action="./api/add_poster.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>預告海報</td>
            <td><input type="file" name="img" id=""></td>
            <td>預告片片名：</td>
            <td><input type="text" name="name" id=""></td>
        </tr>
    </table>
<div>
    <input type="submit" value="新增"><input type="reset" value="重置">
</div>
</form>