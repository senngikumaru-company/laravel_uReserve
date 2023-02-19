# udemy Laravel講座第3弾

## ダウンロード方法

git clone

git clone <https://github.com/senngikumaru-company/laravel_uReserve>

git clone ブランチを指定してダウンロードする場合

git clone -b ブランチ名 <https://github.com/senngikumaru-company/laravel_uReserve>

もしくはZipファイルでダウンロードして下さい

## インストール方法

- cd laravel_uReserve
- composer install
- npm install
- npm run dev

.env.example をコピーして .envファイルを作成

.envファイルの内容をご利用の環境に合わせて変更してください

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_ureserve
DB_USERNAME=ureserve
DB_PASSWORD=password

Xampp/Mamp または他の開発環境でDBを起動した後に、

php artisan migrate:fresh --seed

と実行して下さい(データベーステーブルとダミーデータが追加されればOK)

最後に

php artisan key:generate

と入力してキーを生成後、

php artisan serve

で簡易サーバを立ち上げ、表示確認して下さい

## インストール後の実施事項

画像のリンク
php artisan storage:link

プロフィールページで画像アップロード機能を使う場合は、
.envのAPP_URLを下記に変更して下さい

# APP_URL=http://localhost
APP_URL=http://127.0.0.1:8000

TailwindCSS 3.xのJustInTime機能により、HTML内クラスのみ反映されますので、HTMLを編集する場合は
npm run dev を実行しながら編集するようにして下さい
