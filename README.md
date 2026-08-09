# Self Ordering System

オープンソースのセルフオーダーシステムのテンプレート。  
https://github.com/kawax/self-ordering

> [!WARNING] 
> そろそろメンテナンスは終了する予定です。

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
  - `APP_KEY`は`php artisan key:generate --show`で生成されたキーを使う。 

## ローカルで動かす

↑の新しく作ったプロジェクトを`git clone`後

### Laravel開発環境が揃ってる場合
PHP, composer, node.js/npmがインストール済み。

```bash
composer install
composer run setup
composer run dev
```
http://127.0.0.1:8000/order で表示。

## 開発作業
- 注文を受けると`App\Listeners\OrderEntryListener`が呼び出されるので「注文情報をどこかに送信する」はここで処理。

## LINEに通知機能を使うには追加でインストール
```bash
composer require revolution/laravel-line-sdk
```

## LICENCE
MIT
