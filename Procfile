web: vendor/bin/heroku-php-apache2 public/
worker: php artisan migrate:refresh --seed & php -r "file_exists('.env') || copy('.env.example', '.env');" & php artisan key:generate --ansi & wait -n
