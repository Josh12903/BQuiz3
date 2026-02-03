<div class="half" style="vertical-align:top;">
  <h1>預告片介紹</h1>
  <div class="rb tab" style="width:95%;">
    <div style="box-sizing:border-box">
      <div class="lists">
        <?php 
          // $posters: 從資料庫取得所有顯示狀態(sh)為 1 的預告片資料
          $posters = $Poster->all(['sh' => 1]);
          foreach ($posters as $idx => $poster):
        ?>
        <div class="poster" data-ani="<?= $poster['ani']; ?>">
          <img src="upload/<?= $poster['img'] ?>" style="width:210px;height:220px;">
          <div><?= $poster['name']; ?></div>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="controls">
        <div class='left'></div> <div class="btns">
          <?php foreach ($posters as $idx => $poster): ?>
          <div class="btn"> <img src="upload/<?= $poster['img'] ?>">
            <div><?= $poster['name']; ?></div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class='right'></div> </div>
    </div>
  </div>
</div>

<script>
// --- JavaScript 變數與邏輯 ---

let posters = $(".poster").length; // posters: 總共有幾張預告片

$(".poster").eq(0).show(); // 預設顯示第一張預告片

// slider: 定時器變數，每 3 秒自動執行一次 posterTransition 切換
let slider = setInterval(() => {
  posterTransition();
}, 3000);

/**
 * posterTransition: 核心切換方法
 * @param {number} target - 選填。若有傳值，則切換到指定的索引位置；若無則自動跳下一張。
 */
function posterTransition(target) {
  let current = $(".poster:visible"); // current: 目前正顯示中的預告片物件
  let ani = $(current).data("ani");   // ani: 從 data-ani 取得該預告片的動畫類型 (1, 2, 3)
  let idx = $(current).index();       // idx: 目前顯示片的索引編號
  let next;                           // next: 下一張要顯示的預告片物件

  // 判斷 next 的指向
  if (typeof(target) == 'undefined') {
    // 自動播放邏輯：若沒到最後一張就 +1，否則回到第 0 張
    if (idx + 1 < posters) {
      next = $(".poster").eq(idx + 1);
    } else {
      next = $(".poster").eq(0);
    }
  } else {
    // 若有手動點擊縮圖，則將 next 設為目標索引
    next = $(".poster").eq(target);
  }

  // 根據動畫編號 ani 執行對應的切換效果
  switch (ani) {
    case 1: // 淡入淡出 (Fade)
      $(current).fadeOut(1000, () => {
        $(next).fadeIn(1000);
      });
      break;
    case 2: // 滑入滑出 (Slide)
      $(current).slideUp(1000, () => {
        $(next).slideDown(1000);
      });
      break;
    case 3: // 縮放效果 (Hide/Show)
      $(current).hide(1000, () => {
        $(next).show(1000);
      });
      break;
  }
}

// 點擊下方縮圖按鈕事件
$(".btn").on('click', function() {
  let idx = $(this).index(); // 取得點擊按鈕的索引
  posterTransition(idx);     // 呼叫切換方法
})

let btnPosition = 0; // btnPosition: 紀錄目前縮圖選單滑動的位置索引
// countPosters: 計算「總張數 - 4」，因為畫面一次呈現 4 張，多出的張數就是可滑動的次數
let countPosters = <?= (count($posters) - 4); ?>;

// 縮圖選單左右切換按鈕事件
$(".left,.right").on("click", function() {
  let w = 70; // w: 單個按鈕的寬度 (70px)
  if ($(this).hasClass("left")) {
    if (btnPosition > 0) {
      btnPosition--; // 往左滑動，位置遞減
    }
  } else {
    if (btnPosition < countPosters) {
      btnPosition++; // 往右滑動，位置遞增
    }
  }
  // 使用 animate 改變 CSS right 屬性達成滑動效果
  $(".btn").animate({ right: btnPosition * w }, 500);
})

// 當滑鼠移入縮圖區時停止自動輪播，移出後重新計時
$(".btns").hover(
  function() {
    clearInterval(slider);
  },
  function() {
    slider = setInterval(() => {
      posterTransition();
    }, 3000);
  }
)
</script>

<div class="half">
  <h1>院線片清單</h1>
  <div class="rb tab movies">
    <?php 
      // --- PHP 分頁邏輯 ---
      $today = date("Y-m-d"); // 今天日期
      $ondate = date("Y-m-d", strtotime("-2 days")); // 三天前日期 (題目規定上映三天內)
      
      // $all: 計算符合日期區間且 sh=1 的電影總數
      $all = $Movie->count(" where `sh`=1 && `ondate` between '$ondate' AND '$today'");
      $div = 4; // $div: 每頁顯示 4 筆
      $pages = ceil($all / $div); // $pages: 總頁數
      $now = $_GET['p'] ?? 1;     // $now: 當前頁碼 (沒傳參數預設為 1)
      $start = ($now - 1) * $div; // $start: SQL limit 的起始索引點

      // $movies: 撈取當前頁面要顯示的電影資料
      $movies = q("select * from `movies` where `sh`=1 && `ondate` between '$ondate' AND '$today' order by `rank` limit $start,$div");
      
      foreach ($movies as $movie):
    ?>
    <div class='movie'>
      <div>
        <a href="?do=intro&id=<?= $movie['id']; ?>">
          <img src="upload/<?= $movie['poster']; ?>" style="width:70px;height:95px;">
        </a>
      </div>
      <div>
        <div><?= $movie['name']; ?></div>
        <div>分級:
          <img src="icon/03C0<?= $movie['level']; ?>.png" style="width:20px">
          <?= $levelStr[$movie['level']] ?>
        </div>
        <div>上映日期:<br><?= $movie['ondate']; ?></div>
      </div>
      <div style="width:100%;">
        <button onclick="location.href='?do=intro&id=<?= $movie['id']; ?>'">劇情簡介</button>
        <button onclick="location.href='?do=order&id=<?= $movie['id']; ?>'">線上訂票</button>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <div class="ct"> 
    <?php 
      // 顯示上一頁符號
      if ($now - 1 > 0) {
        echo "<a href='?p=" . ($now - 1) . "'> < </a>";
      }
      // 迴圈跑出所有頁碼按鈕
      for ($i = 1; $i <= $pages; $i++) {
        $fontsize = ($i == $now) ? "24px" : "16px"; // 標註當前頁碼字體放大
        echo "<a href='?p=$i' style='font-size:$fontsize'> $i </a>";
      }
      // 顯示下一頁符號
      if ($now + 1 <= $pages) {
        echo "<a href='?p=" . ($now + 1) . "'> > </a>";
      }
    ?>
  </div>
</div>