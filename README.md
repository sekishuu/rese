# Rese（飲食店アプリ）

## 作成した目的
外部の飲食店予約サービスではなく自社で予約サービスを持つことによってコストを削減したい。

## 更新履歴
- **2024-08-07**: CSVファイルアップロード機能を追加（CSVファイルのアップロード方法は下記を参照）

## 機能一覧
- 会員登録
- ログイン
- ログアウト
- ユーザー情報取得
- ユーザー飲食店お気に入り一覧取得
- ユーザー飲食店予約情報取得
- 飲食店一覧取得
- 飲食店詳細取得
- 飲食店お気に入り追加
- 飲食店お気に入り削除
- 飲食店予約情報追加
- 飲食店予約情報削除
- エリアで検索する
- ジャンルで検索する
- 店名で検索する
- 飲食店予約情報変更
- 来店済み店舗情報取得
- 5段階評価機能
- レビュー機能
- ユーザー登録時のメール認証機能
- 予約者へ予約当日朝にリマインダーメール送信
- 飲食店情報登録（店舗代表者画面）
- 飲食店情報編集（店舗代表者画面）
- 飲食店情報削除（店舗代表者画面）
- 来店チェックイン機能（店舗代表者アカウント）
- 来店チェックイン用QRコード生成
- Stripeアカウント作成
- Stripeを利用した決済機能
- ユーザーアカウント作成（管理者画面）
- ユーザーアカウント編集（管理者画面）
- ユーザーアカウント削除（管理者画面）
- 飲食店情報登録（管理者画面）
- 飲食店情報編集（管理者画面）
- 飲食店情報削除（管理者画面）
- エリア情報登録（管理者画面）
- エリア情報編集（管理者画面）
- エリア情報削除（管理者画面）
- ジャンル情報登録（管理者画面）
- ジャンル情報編集（管理者画面）
- ジャンル情報削除（管理者画面）


## 環境構築

### Dockerビルド
1. リポジトリをクローン
    ```bash
    git clone git@github.com:sekishuu/rese.git
    ```

2. DockerDesktopアプリを立ち上げる

3. Dockerコンテナをビルドおよび起動
    ```bash
    docker-compose up -d --build
    ```

### Laravel環境構築

1. PHPコンテナに入る
    ```bash
    docker-compose exec php bash
    ```

2. Composerで依存関係をインストール
    ```bash
    composer install
    ```

3. 環境変数ファイルの設定
    「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
    ```bash
    cp .env.example .env
    ```

4. .envに以下の環境変数を追加（必要に応じて編集）
    ```env
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=laravel_db
    DB_USERNAME=laravel_user
    DB_PASSWORD=laravel_pass

    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=538aeb2637eb8c
    MAIL_PASSWORD=8f3a37b3bf3d93
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=rese.test@example.com
    MAIL_FROM_NAME="${APP_NAME}"

    STRIPE_KEY=pk_test_51PThJd1M1ZoPwsX9f2HKyRgSnxmE6DAAPcRGAdoeFhyuuIiALaykbhMGZyEtQIRppBLzlk3nnTg46HoGEeRlujJs00Ui7CBuSn
    STRIPE_SECRET=sk_test_51PThJd1M1ZoPwsX9X1OtL4tmFL8JBm8C3Y1uFC7QzclVbl4BaHhZYURz6X9kSrH3VjbJF4ceyPOrmsTLkPzBySiy008OYXZfcm
    ```

5. アプリケーションキーの作成
    ```bash
    php artisan key:generate
    ```
    
6. Doctrine DBAL パッケージのインストール
    ```bash
    composer require doctrine/dbal
    ```

7. マイグレーションの実行
    ```bash
    php artisan migrate
    ```

8. シーディングの実行
    ```bash
    php artisan db:seed
    ```

9. シンボリックリンクの作成
    ```bash
    php artisan storage:link
    ```

10. ファイル権限の設定
    ```bash
    chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache
    ```

## タスクスケジュール（CRON）の設定

1. サーバーで以下のコマンドを実行してCRONジョブを設定
    ```bash
    crontab -e
    ```

2. 以下のエントリを追加して保存
    ```bash
    * * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
    ```

## 使用技術(実行環境)
- PHP: 8.3.2
- Laravel: 8.83.27
- MySQL: 8.0.37

## テーブル設計
![table-design-document](table-design-document.png)

## ER図
![ER図](rese.drawio.png)

## URL
- 開発環境：http://localhost/
- phpMyAdmin:：http://localhost:8080/

## サイトイメージ画像

### 飲食店一覧画面
![index](index-page.png)

### 店舗代表者画面
![shop-owner](shop-owner-page.png)

### サイト管理者画面
![admin](admin-page.png)

## アカウントの種類
- general：一般ユーザー
- shop_owner：店舗代表者
- admin：サイト管理者

## テストアカウントログイン用メールアドレス
- 一般ユーザー：ippan@example.com
- 店舗代表者：tenpo@example.com
- サイト管理者：admin@example.com
  
※PWは0000

## CSVファイルのアップロード方法

### CSVファイルの作成方法

#### ファイルに含める項目
以下の項目を含むCSVファイルを作成してください。

- 店舗名：50文字以内で入力してください。
- 地域：「東京都」「大阪府」「福岡県」のいずれかを入力してください。
- ジャンル：「寿司」「焼肉」「イタリアン」「居酒屋」「ラーメン」のいずれかを入力してください。
- 店舗概要：400文字以内で入力してください。
- 画像URL：jpegまたはpng形式の画像のみアップロード可能です。

#### CSVファイルの作成例

以下のように項目を入力してください。

| 店舗名  | 地域   | ジャンル | 店舗概要                | 画像URL                                   |
| ------- | ------ | -------- | ---------------------- | ---------------------------------------- |
| 寿司一番 | 東京都 | 寿司     | 新鮮なネタを提供する寿司店 | http://example.com/sushi.jpg              |
| 焼肉大王 | 大阪府 | 焼肉     | 美味しい焼肉を提供します   | http://example.com/yakiniku.png          |
| イタリアンの店 | 福岡県 | イタリアン | 本格イタリアン料理を提供します | http://example.com/italian.jpeg          |

1. **ExcelやGoogleスプレッドシートを使用する場合**:
   - Excelを使用する場合：「ファイル」→「名前を付けて保存」→「ファイルの種類」で「CSV (コンマ区切り) (*.csv)」を選択して保存。
   - Googleスプレッドシートを使用する場合：「ファイル」→「ダウンロード」→「Comma-separated values (.csv)」を選択して保存。

2. **テキストエディタを使用する場合**:
   - お好みのテキストエディタ（例：VSCode、Notepad++）を開き、上記の作成例を参考に入力します。
   - ファイル名の拡張子を「.csv」にして保存します（例：shops.csv）。

### CSVファイルのアップロード手順

1. 管理者ページにログインします。
2. 管理者ページの「店舗」タブを選択します。
3. 「ファイルを選択」ボタンを押し、先ほど作成したCSVファイルを選択します。
4. 「CSVファイルをアップロード」ボタンをクリックして、CSVファイルをアップロードします。
5. アップロードが完了すると、店舗情報がシステムに反映されます。



この内容に従ってCSVファイルを作成し、システムにアップロードしてください。

