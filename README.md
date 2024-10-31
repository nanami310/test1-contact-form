# お問い合わせホーム
## 環境構築
Dockerビルド

1. clone git@github.com:coachtech-material/laravel-docker-template.git
2. docker-compose up -d --build

Laravel環境構築

1. docker-compose exec php bash
2. composer install
3. cp .env.example .env
4. 環境変数を変更
5. php artisan migrate

## 使用技術
- PHP 8.0
- Laravel 10.0
- MySQL 8.0

## ER図
![Screenshot of a comment on a GitHub issue showing an image, added in the Markdown, of an Octocat smiling and raising a tentacle.](/test1.drawio.png)

## URL
- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/
