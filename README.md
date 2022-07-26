## ロバミミ
![スクリーンショット 2022-07-26 18 24 59](https://user-images.githubusercontent.com/56643466/180973857-53cfc39d-967e-4226-b037-e2c7911d0fc4.png)

![スクリーンショット 2022-07-26 18 28 32](https://user-images.githubusercontent.com/56643466/180974039-a2621deb-e9dc-4f11-98bf-dd5085de6e0f.png)

* 『ロバミミ』は**ネタバレを防止する事に特化した**スレッド型SNSです。
* 「SNSでネタバレくらった！」という知り合いの発言をきっかけに作成しました。
* 投稿者がスレッドを立てることでコンテンツの感想をクローズドな環境で共有し合うことができます。

## 技術スタック

### 言語・フレームワーク

- PHP 7.4.21
- Laravel 8.83.2
- Vue 2.6.14

### 開発環境

- MAMP
- Apache(Web サーバー)

### 本番環境

- AWS (EC2・S3・Route53)


### 機能一覧
- ユーザー登録・ログイン機能(Laravel UI)
- ユーザー画像のアップロード (AWS S３)
- Twitter認証機能(Twitter API)
- スレッド投稿・検索機能
- コメント投稿機能
- いいね機能(Vue.js)
- 通知機能

## 設計

### 要件定義書

https://quip.com/rcawAPhqQZWt

### テーブル設計(ER 図)

![スクリーンショット 2022-07-26 18 50 38](https://user-images.githubusercontent.com/56643466/180978462-99180ae2-3671-4a6e-b275-defdcd76d6e5.png)

## 環境構築

- takaakimatsuda/robamimi リポジトリをcloneしてください。
