web: vendor/bin/heroku-php-apache2 public/
worker: php artisan migrate:refresh --seed
worker: php -r "file_exists('.env') || copy('.env.example', '.env');"
worker: php artisan key:generate --ansi
