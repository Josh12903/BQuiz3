<style>
  .lists{
    width:210px;
    height:240px;
    margin:auto;
    position:relative;

    /* background:skyblue; */
  }
  .controls{
    width: 420px;
    height: 120px;
    margin:10px auto;
    display:flex;
    align-items:center;
    justify-content:space-between;

    /* background:lightgreen; */
  }
  .btns{
    width: 280px;
    height:100px;
    display:flex;
    overflow:hidden;

  }
  .btn{
    text-align: center;
    font-size:12px;
    width: 70px;
    flex-shrink:0;

    position: relative;

  }

  .left{
    width: 0;
    border-left:18px solid transparent;
    border-right:35px solid orange;
    border-top:20px solid transparent;
    border-bottom:20px solid transparent;
  }
  .right{
    width: 0;
    border-right:18px solid transparent;
    border-left:35px solid orange;
    border-top:20px solid transparent;
    border-bottom:20px solid transparent;
  }

  .poster{
    width:200px;
    height:220px;
    position:absolute;
    text-align: center;
  }

  .btn img {
    width:60px;
    height:70px;
    
  }
</style>
<div class="half" style="vertical-align:top;">
      <h1>預告片介紹</h1>
      <div class="rb tab" style="width:95%;">
        <div id="abgne-block-20111227">
          <div class="lists">
            <?php
            $posters=$Poster->all(['sh'=>1]);
            foreach($posters as $idx => $poster):
            ?>
              <div class="poster">
                <img src="pic/<?=$poster['img'];?>">
                <div><?=$poster['name'];?></div>
              </div>
            <?php
            endforeach;
            ?>
          </div>
          <div class="controls">
            <div class="left"></div>
            <div class="btns">
              <?php
              foreach($posters as $idx => $poster):
              ?>
              <div class="btn">
                <img src="pic/<?=$poster['img'];?>">
                <div><?=$poster['name'];?></div>
              </div>
              <?php
              endforeach;
              ?>
            </div>
            <div class="right"></div>
          </div>
        </div>
      </div>
    </div>
    <script>
      
    </script>
    <style>
      .movies{
        width:95%;
        display:flex;
        flex-wrap:wrap;
        justify-content:space-between;
        align-items:center;
        align-content:space-evenly;
      }

      .movie{
        background-color:#eee;
        box-sizing:border-box;
        width:48%;
        height:150px;
        margin-bottom:10px;
        padding:3px;
        color:black;
        display:flex;
        flex-wrap:wrap;
        color:black;
        border-radius:4.5px;
      }
    </style>
    <div class="half">
      <h1>院線片清單</h1>
      <div class="rb tab movies">
        <?php
          $today=date("Y-m-d");
          $ondate=date("Y-m-d",strtotime("-2 days"));

          $all=$Movie->count(" where `sh`=1 && `ondate` between '$ondate' AND '$today'");
          $div=4;
          $pages=ceil($all/$div);
          $now=$_GET['p']??1;
          $start=($now-1)*$div;

          $movies=q("select * from `movies` where `sh`=1 && `ondate` between '$ondate' AND '$today' order by `rank`");
          foreach($movies as $movie):
        ?>
        <div class="movie">
          <div>
            <a href="?do=intro&id=<?=$movie['id'];?>">
            <img src="pic/<?=$movie['poster'];?>" style="width:70px;height:95px">
            </a>
          </div>
                    <div>
                      <div><?=$movie['name'];?></div>
                      <div>分級：
                        <img src="icon/03C0<?=$movie['level'];?>.png" style="width:20px">
                        <?=$levelStr[$movie['level']]?>
                      </div>
                      <div>
                        上映日期：<br><?=$movie['ondate'];?>
                      </div>
                    </div>
          <div style="width:100%;">
            <button onclick="location.href='?do=intro&id=<?=$movie['id'];?>'">劇情簡介</button>
            <button>線上訂票</button>
          </div>
        </div>
        <?php
        endforeach;
        ?>
      </div>
        <div class="ct">
          <?php
            if($now-1>0){
              echo "<a href='?p=".($now-1)."'> < </a>";
            }

            for($i=1;$i<=$pages;$i++){
              $fontsize=($i==$now)?"24px":"16px";
              echo "<a href='?p=$i'> $i </a>";
            }

            if($now+1<=$pages){
              echo "<a href='?p=".($now+1)."'> > </a>";
            }
          ?>
        </div>
    </div>