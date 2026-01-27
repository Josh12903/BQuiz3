<div>預告片清單</div>

<div style="display:flex;justify-content:space-between">
    <div class="ct">預告片海報</div>
    <div class="ct">預告片片名</div>
    <div class="ct">預告片排序</div>
    <div class="ct">操作</div>
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