<h2>アプリケーション名</h2>
<p>coachtechフリマ</p>

<h2>環境構築</h2>
<p>git clone git@github.com:mona12298/marketplace-app.git</p>
<p>cd marketplace-app</p>
<p>docker-compose build</p>
<p>docker-compose up -d</p>
<p>docker-compose exec php bash</p>
<p>composer install</p>
<p>.env.exampleファイルから.envを作成し、環境変数を変更</p>
<p>php artisan key:generate</p>
<p>php artisan migrate</p>
<p>php artisan db:seed</p>
<p>php artisan storage:link</p>
<h3>テスト環境構築</h3>
<p>docker-compose exec php bash</p>
<p>composer init</p>
<p>Package name (<vendor>/<name>) [root/www]: monami/marketplace-app</p>
<p>Add PSR-4 autoload mapping? Maps namespace "Monami\MarketplaceApp" to the entered relative path. [src/, n to skip]: src/</p>
<p>Do you confirm generation [yes]? yes</p>
<p>composer require --dev phpunit/phpunit</p>
<p>composer install</p>

<h2>使用技術</h2>
<p>言語: php 7.4.9</p>
<p>フレームワーク: Laravel 8.83.8</p>
<p>データベース: MySQL 8.0.26 </p>
<p>Docker: Docker, docker-compose</p>

<h2>ER図</h2>
<img src="./marketplace-app.drawio.png" alt="ER図">

<h2>URL</h2>
<p>開発環境：http://localhost/</p>
<p>phpMyAdmin：http://localhost:8080/</p>
