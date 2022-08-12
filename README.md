# ネタバレを気にせず感想を共有できるSNS<br>webアプリケーション『ロバミミ』

![top_1](https://user-images.githubusercontent.com/56643466/183625715-9fb5e1f6-f5c2-4eca-9498-f6bbd10d125e.png)


![top_2](https://user-images.githubusercontent.com/56643466/183625814-b8c52f35-4d42-4404-8030-95bceaf58493.png)


# 概要

『ロバミミ』はネタバレを防止する事に特化した**スレッド型SNS**です。

投稿者がスレッドを立てることでコンテンツの感想をクローズドな環境で共有し合うことができます。

# 制作背景

友人が「**SNSで作品のネタバレをくらった！**」という発言をきっかけに作成しました

Twitterは仕様上、新しい情報を無造作に目にしてしまいます。ミュート機能などを駆使しても100%見たくない情報をシャットダウンすることは出来ません。

ネタバレを気にしてしまう人は情報を見てしまうリスクがある・ネタバレを気にしない人はタイムリーな情報を発信するのに気を遣う状況が出来てしまいます。

課題まとめ
* Twitterではネタバレ情報を見てしまうリスクがある。
* ネタバレの情報を発信したいがネタバレに気を遣って発信できない。
* ネタバレ情報を見た人間と見ていない人間でお互いに負の感情を抱いてしまう。

上記の課題を解決したいと考え、このサービスを開発しました。

### URL:[https://robamimi6833.com](https://robamimi6833.com)(『ゲストログイン』ボタンですぐ利用できます)

# 基本操作説明
### ●スレッドの新規作成

※ログイン後(ユーザー登録必須)

視聴した作品のタイトルでスレッドを作成
![thread_sakusei](https://user-images.githubusercontent.com/56643466/184283297-aec4f537-f0d2-4c69-a859-6d07ed67c1f5.gif)

### ●コメントの新規作成

作成したスレッドに関するコメントを作成
![comment_sakusei](https://user-images.githubusercontent.com/56643466/183626623-739f6996-4781-42f1-a352-7982828c284d.gif)

### ●いいねボタンを押す

気に入った感想コメントにはいいねボタンを押す（相手に通知が届きます）
![iine](https://user-images.githubusercontent.com/56643466/183626649-293476f7-db6c-4385-8553-561156e5c44c.gif)

### ●スレッド検索機能

気になる作品についてスレッドが出来ているかを確認できます
![kensaku](https://user-images.githubusercontent.com/56643466/183626675-b4e0f14e-b251-4027-af85-c9ea46b8ce84.gif)

# 技術スタック

### バックエンド
PHP 7.4.21 / Laravel 8.83.2

### フロントエンド
HTML / CSS / Vue / Bootstrap

### データベース
mysql 14.14

### インフラ
AWS(EC2, S3, RDS, Route 53)

### その他の使用技術
Git(GitHub) / Visual Studio Code / Let's Encrypt(SSL証明書の発行)

# 要件定義書

URL(Quip):[https://quip.com/rcawAPhqQZWt](https://quip.com/rcawAPhqQZWt)
# 画面遷移図

URL(Figma):[https://www.figma.com/file/ucfh2sUuKbIMBObYhoy4yA/%E3%83%AD%E3%83%90%E3%83%9F%E3%83%9F?node-id=2%3A214](https://www.figma.com/file/ucfh2sUuKbIMBObYhoy4yA/%E3%83%AD%E3%83%90%E3%83%9F%E3%83%9F?node-id=2%3A214)

# AWS構成図

![robamimi](https://user-images.githubusercontent.com/56643466/184115703-f9af82af-0fa9-41da-b4ac-e698f0f505d0.png)

# テーブル設計(ER 図)

![robamimi_er](https://user-images.githubusercontent.com/56643466/184161385-5e07b204-95de-41ef-a86e-db647c4afa24.png)

# アプリ機能一覧
- ユーザー登録機能
- ログイン・ログアウト機能
- パスワードリセット機能
- Twitterログイン機能
- スレッド投稿機能
- コメント投稿機能
- 検索機能
- ページネーション機能
- いいね機能
- 通知機能
