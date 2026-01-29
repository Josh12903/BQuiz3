<h3 class="ct">編輯院線片</h3>

<form action="./api/add_movie.php" method="post">
    <table style="width:70%;margin:auto">
        <tr>
            <td>影片資料</td>
            <td>
                <div>
                    <lable>片名：</lable>
                    <input type="text" name="name" id="">
                </div>
                <div>
                    <lable>分級：</lable>
                    <select name="level" id="">
                        <option value="1">普遍級</option>
                        <option value="2">輔導級</option>
                        <option value="3">保護級</option>
                        <option value="4">限制級</option>
                    </select>(選擇分級)
                </div>
                <div>
                    <lable>片長：</lable>
                    <input type="text" name="length" id="">
                </div>
                <div>
                    <lable>上映日期：</lable>
                    <select name="year" id="">
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                    </select>年
                    <select name="month" id="">
                        <?php
                            for($i=1;$i<13;$i++){
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>月
                    <select name="date" id="">
                        <?php
                            for($i=1;$i<32;$i++){
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>日
                </div>
                <div>
                    <lable>發行商：</lable>
                    <input type="text" name="publisher" id="">
                </div>
                <div>
                    <lable>導演：</lable>
                    <input type="text" name="director" id="">
                </div>
                <div>
                    <lable>預告影片：</lable>
                    <input type="file" name="trailer" id="">
                </div>
                <div>
                    <lable>電影海報：</lable>
                    <input type="file" name="poster" id="">
                </div>
            </td>
        </tr>
        
        <tr>
            <td>劇情簡介</td>
            <td>
                <textarea name="intro" style="width:95%;height:50px"></textarea>
            </td>
        </tr>
    </table>
    <div class="ct">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
    </div>
</form>

