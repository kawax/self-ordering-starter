# Self Ordering System

オープンソースのセルフオーダーシステムのテンプレート。  
https://github.com/kawax/self-ordering

## デモサイトのURL
- QRコード表示 https://self-ordering-starter.vercel.app/
- メニュー選択 https://self-ordering-starter.vercel.app/order
- 管理画面(パスワードは`secret`) https://self-ordering-starter.vercel.app/login

## Vercelですぐに動かす
事前にGitHubとVercelのアカウントを準備。  
https://vercel.com/

- GitHubで`Use this template`から新しいプロジェクトを作る。
- Vercelで`New Project`から今作ったプロジェクトをインポート。
- インポート時にはEnvironment Variablesで`APP_KEY`の追加だけ必須。
  - `APP_KEY`はここでランダムに生成されたキーを使う。 https://laravel-app-key.vercel.app/ 

## ローカルで動かす

↑の新しく作ったプロジェクトを`git clone`後

### Laravel開発環境が揃ってる場合
PHP, composer, node.js/npmがインストール済み。

```
composer install

cp .env.example .env
php artisan key:generate

npm i && npm run prod

php artisan serve
```
http://127.0.0.1:8000/order で表示。

### Dockerのみインストール済みの場合
starterプロジェクトで開始する場合はPHP/composerも必要。

```
composer install

cp .env.example .env

./vendor/bin/sail artisan key:generate

./vendor/bin/sail npm i

./vendor/bin/sail npm run prod

./vendor/bin/sail up -d
```
http://localhost/order で表示。

## 開発作業
- 注文を受けると`App\Listeners\OrderEntryListener`が呼び出されるので「注文情報をどこかに送信する」はここで処理。

## LICENCE
MIT
