# Self Ordering System

オープンソースのセルフオーダーシステムのテンプレート。  
https://github.com/kawax/self-ordering

## URL
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


## LICENCE
MIT
