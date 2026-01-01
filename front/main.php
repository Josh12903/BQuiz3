<div class="half" style="vertical-align:top;">
      <h1>預告片介紹</h1>
      <div class="rb tab" style="width:95%;">
        <div id="abgne-block-20111227">
          <ul class="lists">
          </ul>
          <ul class="controls">
          </ul>
        </div>
      </div>
    </div>
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
        color:black;
        display:flex;
        flex-wrap:wrap;
        color:black;
      }
    </style>
    <div class="half">
      <h1>院線片清單</h1>
      <div class="rb tab movies">
        <?php
          $today=date("Y-m-d");
          $ondate=date("Y-m-d",strtotime("-2 days"));
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
        <div class="ct"> </div>
    </div>