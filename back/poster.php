<div>預告片清單</div>

<div style="display:flex;justify-content:space-between">
    <div class="ct" style="width:25%">預告片海報</div>
    <div class="ct" style="width:25%">預告片片名</div>
    <div class="ct" style="width:25%">預告片排序</div>
    <div class="ct" style="width:25%">操作</div>
</div>
<form action="./api/edit_poster.php" method="post">
<div style="height:300px;overflow:auto">
    <?php
    $posters=$Poster->all(" ORDER BY `rank` ASC");
    foreach($posters as $poster):
    ?>    
        <div style="display:flex;justify-content:space-between;margin:3px 0">
            <div class="ct" style="width:25%">
                <img src="./pic/<?=$poster['img'];?>" style="width:60px;height:80px">    
            </div>
            <div class="ct" style="width:25%">
                <input type="text" name="name[]" value="<?=$poster['name'];?>">
            </div>
            <div class="ct" style="width:25%">
                <input type="button" value="往上">
                <input type="button" value="往下">
            </div>
            <div class="ct" style="width:25%">
                <select name="ani" id="">
                    <option value="1" <?=($poster['ani']==1)?'selected':'';?>>淡入淡出</option>
                    <option value="2" <?=($poster['ani']==2)?'selected':'';?>>滑入滑出</option>
                    <option value="3" <?=($poster['ani']==3)?'selected':'';?>>縮放</option>
                </select>
                <input type="checkbox" name="sh[]" value="<?=$poster['id'];?> <?=($poster['sh'==1])?'checked':'';?>">顯示
                <input type="checkbox" name="del[]" value="<?=$poster['id'];?>">刪除
                <input type="hidden" name="id[]" value="<?=$poster['id'];?>">
            </div>
        </div>
    
        <?php
    endforeach;
    ?>
    <div class="ct">
    <input type="submit" value="編輯確定">
    <input type="submit" value="重置">
    </div>
</div>
</form>






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