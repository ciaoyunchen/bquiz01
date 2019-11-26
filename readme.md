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
  
## 步驟三：進行前後台的檔案整理及切版，分離出共用的區塊或功能。
  1. 建立 `front`及 `admin` 兩個目錄，一個代表前台的相關檔案，一個代表後台的相關檔案，前後台共用的元件則先放在根目錄下，或另開一個 `comm` 目錄用來存放共用的元件
  2. 分離出頁首標題及頁尾頁腳的區塊成為 `header.php` 及 `footer.php`
  3. 前台的 `login.php` 及 `news.php` 去除和 `index.php` 相同的部份，只留下中間區塊即可，並將檔案移到 `./front` 目錄下
  4. 前台的 `index.php` 控出中間的區塊成為獨立的 `home.php` 檔案，並搬移到 `./front/` 目錄下
  5. 後台的 `admin.php` 則挖出中間的區塊成為獨立的元件，在整理後成為九個後台功能的基礎版型檔案。
  6. 使用 `include` 指令來重新組合 `index.php` 及 `admin.php` 頁面，並加上判斷式來確保要組合的檔案是存在的。
  7. 以 `get` 的方式來傳遞各頁面要組合的元件內容，比如 `do=login` 表示要看到的是登入頁面，因此在前台的 `include` 中可以併入 `login.php` 來呈現。
  8. 在 `./front` 目錄中，將 `login.php`, `news.php`, `home.php` 中的 `<marquee>...</marquee>` 也獨立成為一個元件，並放在 `./front/` 目錄下
  9. 在 `./admin` 目錄下根據 `title.php` 來增加其它八項功能的檔案，並更改對應的檔名及檔案內的功能標題內容
  10. 修改 `admin.php` 左方選單中的連結內容由 `href="?do=admin&redo=title"` 改成 `href="?do=title"`，並確認連結可以看到對應的功能內容

```
note:
news.php 及 home.php 下方的<script></script>是用來做為最新消息彈出視窗用的，因此在切割檔案時，要記得連script的部份一起切出去
```
