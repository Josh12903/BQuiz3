<?php
/**
 * ========================================
 * db.php - 資料庫操作核心檔案
 * ========================================
 * 功能：提供資料庫連接與 CRUD 操作的封裝類別
 * 用途：被其他頁面 include/require 引入後使用
 * ========================================
 */

// ========================================
// 第一部分：環境設定
// ========================================

/**
 * 啟動 Session
 * 功能：開始一個新的或恢復現有的 session
 * 去向：用於追蹤使用者狀態（如登入狀態、訪客計數等）
 */
session_start();

/**
 * 設定時區
 * 功能：將 PHP 預設時區設為台北時間
 * 去向：影響所有時間相關函數的輸出（如 date()、time() 等）
 */
date_default_timezone_set("Asia/Taipei");

// ========================================
// 第二部分：工具函數（Helper Functions）
// ========================================

/**
 * dd() - Debug and Die（除錯輸出函數）
 * 功能：格式化輸出陣列內容，方便開發時除錯
 * 參數：$array - 要輸出的陣列
 * 去向：通常在開發階段使用，正式上線時移除
 * 使用範例：dd($users); // 輸出 $users 陣列內容
 */
function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

/**
 * q() - Quick Query（快速查詢函數）
 * 功能：執行 SQL 查詢並返回所有結果
 * 參數：$sql - 要執行的 SQL 語句
 * 返回：關聯陣列格式的查詢結果
 * 去向：用於簡單的資料庫查詢，不需要建立物件
 * 使用範例：$data = q("SELECT * FROM users");
 */
function q($sql){
    $dsn='mysql:host=localhost;dbname=db09;charset=utf8';
    $pdo=new PDO($dsn,'root','');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * to() - 頁面跳轉函數
 * 功能：將使用者重新導向到指定的 URL
 * 參數：$url - 目標網址
 * 去向：用於表單處理後的頁面跳轉（如登入成功後跳轉）
 * 使用範例：to("index.php"); // 跳轉到首頁
 */
function to($url){
    header("location:".$url);
}

// ========================================
// 第三部分：DB 類別（資料庫操作類別）
// ========================================

/**
 * DB 類別 - 資料庫 CRUD 操作封裝
 * 功能：提供對資料表的新增、查詢、修改、刪除操作
 * 設計模式：Active Record 簡化版
 * 去向：被實例化後用於操作各個資料表
 */
class DB{
    // ---- 私有屬性 ----
    
    /**
     * DSN（Data Source Name）資料來源名稱
     * 功能：定義資料庫連線資訊
     * 內容：主機位置、資料庫名稱、字元編碼
     */
    private $dsn="mysql:host=localhost;dbname=db09;charset=utf8";
    
    /**
     * PDO 連線物件
     * 功能：儲存資料庫連線實例
     */
    private $pdo;   
    
    /**
     * 資料表名稱
     * 功能：儲存當前操作的資料表名稱
     */
    private $table;

    // ---- 建構函數 ----
    
    /**
     * __construct() - 建構函數
     * 功能：初始化 DB 物件，建立資料庫連線
     * 參數：$table - 要操作的資料表名稱
     * 去向：建立物件時自動執行
     * 使用範例：$User = new DB('users');
     */
    function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,"root",'');
    }

    // ---- 查詢方法（Read）----
    
    /**
     * all() - 查詢所有資料
     * 功能：從資料表中取得多筆資料
     * 參數：
     *   $arg[0] - 可選，WHERE 條件（陣列或字串）
     *   $arg[1] - 可選，額外的 SQL 語句（如 ORDER BY、LIMIT）
     * 返回：關聯陣列格式的所有符合條件的資料
     * 去向：用於列表頁面、後台管理等需要顯示多筆資料的地方
     * 使用範例：
     *   $users = $User->all();  // 取得所有使用者
     *   $users = $User->all(['status'=>1]);  // 取得 status=1 的使用者
     *   $users = $User->all("ORDER BY id DESC", "LIMIT 10");  // 依 id 降序取前 10 筆
     */
    function all(...$arg){
        $sql="select * from $this->table ";
        
        // 處理第一個參數：WHERE 條件
        if(isset($arg[0])){
            if(is_array($arg[0])){
                // 如果是陣列，轉換為 SQL 條件語句
                $tmp=$this->arraytosql($arg[0]);
                
                $sql=$sql." where ".join(" AND " , $tmp);

            }else{
                // 如果是字串，直接附加到 SQL
                $sql .= $arg[0];
            }
        }

        // 處理第二個參數：額外的 SQL 語句
        if(isset($arg[1])){
            $sql .= $arg[1];
        }

        // 執行查詢並返回結果
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * count() - 計算資料筆數
     * 功能：計算資料表中符合條件的資料筆數
     * 參數：與 all() 相同
     * 返回：符合條件的資料筆數（整數）
     * 去向：用於分頁計算、統計數量等
     * 使用範例：
     *   $total = $User->count();  // 計算所有使用者數量
     *   $active = $User->count(['status'=>1]);  // 計算啟用的使用者數量
     */
    function count(...$arg){
        $sql="select count(*) from $this->table ";
        
        // 處理 WHERE 條件
        if(isset($arg[0])){
            if(is_array($arg[0])){
                $tmp=$this->arraytosql($arg[0]);
                $sql=$sql." where ".join(" AND " , $tmp);

            }else{
                $sql .= $arg[0];
            }
        }

        // 處理額外的 SQL 語句
        if(isset($arg[1])){
            $sql .= $arg[1];
        }

        // 返回單一欄位值（筆數）
        return $this->pdo->query($sql)->fetchColumn();
    }

    /**
     * find() - 查詢單筆資料
     * 功能：根據條件查詢單筆資料
     * 參數：$id - ID 值或條件陣列
     * 返回：單筆資料的關聯陣列，若無資料則返回 false
     * 去向：用於編輯頁面、詳情頁面等需要顯示單筆資料的地方
     * 使用範例：
     *   $user = $User->find(1);  // 查詢 id=1 的使用者
     *   $user = $User->find(['email'=>'test@example.com']);  // 依 email 查詢
     */
    function find($id){
        $sql="select * from $this->table ";
        
        if(is_array($id)){
            // 陣列條件：轉換為 SQL WHERE 語句
            $tmp=$this->arraytosql($id);
            $sql=$sql." where ".join(" AND " , $tmp);

        }else{
            // 單一 ID：直接查詢該 ID
            $sql .= " WHERE `id`='$id'";
        }
        //echo $sql;
        
        // 返回單筆資料
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    // ---- 新增/更新方法（Create / Update）----
    
    /**
     * save() - 儲存資料（新增或更新）
     * 功能：根據陣列內容決定是新增還是更新資料
     * 參數：$array - 要儲存的資料陣列
     * 返回：受影響的資料筆數
     * 邏輯：
     *   - 若陣列包含 'id' 鍵 → 執行 UPDATE
     *   - 若陣列不包含 'id' 鍵 → 執行 INSERT
     * 去向：用於表單處理，統一處理新增與編輯
     * 使用範例：
     *   // 新增資料
     *   $User->save(['name'=>'John', 'email'=>'john@example.com']);
     *   
     *   // 更新資料
     *   $User->save(['id'=>1, 'name'=>'John Updated']);
     */
    function save($array){
        if(isset($array['id'])){
            // UPDATE：有 id 表示要更新現有資料
            $sql="update $this->table set ";
            $tmp=$this->arraytosql($array);
            $sql.= join(" , ",$tmp) . "where `id`= '{$array['id']}'";
        }else{
            // INSERT：無 id 表示要新增資料
            $cols=join("`,`",array_keys($array));
            $values=join("','",$array);
            $sql="insert into $this->table (`$cols`) values('$values')";
        }

        // 執行 SQL 並返回受影響的筆數
        return $this->pdo->exec($sql);
    }

    // ---- 刪除方法（Delete）----
    
    /**
     * del() - 刪除資料
     * 功能：根據條件刪除資料
     * 參數：$id - ID 值或條件陣列
     * 返回：受影響的資料筆數
     * 去向：用於刪除功能
     * 使用範例：
     *   $User->del(1);  // 刪除 id=1 的資料
     *   $User->del(['status'=>0]);  // 刪除所有 status=0 的資料
     */
    function del($id){
        $sql="delete  from $this->table ";
        
        if(is_array($id)){
            // 陣列條件
            $tmp=$this->arraytosql($id);
            $sql=$sql." where ".join(" AND " , $tmp);

        }else{
            // 單一 ID
            $sql .= " WHERE `id`='$id'";
        }
        //echo $sql;
        
        // 執行刪除並返回受影響的筆數
        return $this->pdo->exec($sql);
    }

    // ---- 私有輔助方法 ----
    
    /**
     * arraytosql() - 陣列轉 SQL 條件
     * 功能：將關聯陣列轉換為 SQL 條件語句
     * 參數：$array - 關聯陣列（如 ['name'=>'John', 'age'=>25]）
     * 返回：SQL 條件片段陣列（如 ["`name`='John'", "`age`='25'"]）
     * 去向：被 all()、find()、save()、del() 等方法內部使用
     * 使用範例：
     *   $this->arraytosql(['name'=>'John']) → ["`name`='John'"]
     */
    private function arraytosql($array){
        $tmp=[];
        foreach($array as $key => $value){
            $tmp[]="`$key`='$value'";
        }

        return $tmp;
    }

}

// ========================================
// 第四部分：資料表物件實例化
// ========================================

/**
 * 以下建立各資料表的 DB 物件實例
 * 功能：預先建立常用資料表的操作物件
 * 去向：被引入此檔案的頁面直接使用
 * 
 * 命名規則：物件名稱使用大寫開頭，對應資料表名稱
 */
$Title=new DB('title');     // 網站標題資料表
$Ad=new DB('ad');           // 廣告資料表
$Mvim=new DB('mvim');       // 主視覺圖片資料表
$Image=new DB('image');     // 圖片資料表
$News=new DB('news');       // 最新消息資料表
$Admin=new DB('admin');     // 管理員資料表
$Menu=new DB('menu');       // 選單資料表
$Total=new DB('total');     // 訪客統計資料表
$Bottom=new DB('bottom');   // 頁尾資訊資料表

// ========================================
// 第五部分：訪客計數功能
// ========================================

/**
 * 訪客計數邏輯
 * 功能：統計網站的不重複訪客數量
 * 邏輯：
 *   - 檢查 session 中是否有 'visit' 標記
 *   - 若無（第一次來訪）：訪客總數 +1 並設立標記
 *   - 若有（重複訪問）：不再計數
 * 去向：每次載入頁面時自動執行
 */
if(!isset($_SESSION['visit'])){
    // 第一次來訪：更新訪客計數
    $t=$Total->find(1);      // 取得訪客統計資料
    $t['total']++;           // 訪客數 +1
    $Total->save($t);        // 儲存更新後的數據
    $_SESSION['visit']=1;    // 設立訪問標記，避免重複計數
}

// ========================================
// 程式碼結構說明
// ========================================
/**
 * 【此順序寫法的用意】
 * 
 * 1. 環境設定優先（session_start、時區設定）
 *    → 必須在任何輸出之前執行
 *    → Session 需最早啟動以確保後續功能正常運作
 * 
 * 2. 工具函數定義（dd、q、to）
 *    → 提供全域使用的輔助函數
 *    → 放在類別之前，讓類別內也能使用
 * 
 * 3. DB 類別定義
 *    → 封裝所有資料庫操作邏輯
 *    → 遵循 OOP（物件導向）設計原則
 *    → 提供統一的 CRUD 介面
 * 
 * 4. 物件實例化
 *    → 預先建立常用資料表的物件
 *    → 讓引入此檔案的頁面可直接使用
 *    → 減少重複的 new DB() 程式碼
 * 
 * 5. 自動執行邏輯（訪客計數）
 *    → 放在最後，確保所有依賴都已準備就緒
 *    → 每次載入頁面時自動執行
 * 
 * 【設計優點】
 * - 程式碼重用：一次定義，到處使用
 * - 維護方便：修改資料庫設定只需改一處
 * - 簡化操作：透過物件方法取代原始 SQL
 * - 可讀性高：語義化的方法名稱（all、find、save、del）
 */




?>