!#/bin/bash

echo "secret" | sudo -S chown -R drg:www-data /app
composer install
php artisan key:generate

echo "secret" | sudo -S chown -R drg:www-data bootstrap/
chmod -R 774 bootstrap/

echo "secret" | sudo -S chown -R drg:www-data public/
chmod -R 774 public/

echo "secret" | sudo -S chown -R drg:www-data storage/
chmod -R 774 storage/app/public
chmod -R 774 storage/logs
chmod -R 774 storage/framework/cache
chmod -R 774 storage/framework/sessions
chmod -R 774 storage/framework/views

php artisan migrate:fresh --seed

