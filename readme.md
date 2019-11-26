# 題組一解題步驟

## 步驟一：將素材目錄複製到岡位目錄下，確認素材內容與抽題題號一致

## 步驟二：將版型檔案及相關素材複製到網站根目錄下，並進行相應的更名及整理
  1. 開立./css, ./js, ./img, ./icon等常用目錄以利檔案分類及管理
  2. 將素材檔中的.css, .js, 及icon圖檔複製到相應的目錄下
  3. 更改版型素材的相關檔名，以符合解題的需要
      * 01P01.html => login.php
      * 01P02.html => index.php
      * 01P03.html => admin.php
      * 01P04.html => news.php
  4. 更改版型素材的相關連結及匯入檔內容
      * 修改 `link` 及 `script` 中的連結路徑，指向正確的位置
      * 修改 `./css/css.css` 中的圖片 `url` ，指向根目錄下的 `./icon` 目錄
  5. 開啟 `xampp` 及 `apache` 伺服器，使用 `localhost` 或 `127.0.0.1` 檢視網頁是否正確顯示，css 的載入是否正確
  
  