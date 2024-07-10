# Rese（飲食店アプリ）

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

6. マイグレーションの実行
    ```bash
    php artisan migrate
    ```

7. シーディングの実行
    ```bash
    php artisan db:seed
    ```

8. シンボリックリンクの作成
    ```bash
    php artisan storage:link
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
