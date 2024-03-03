#!/bin/bash

#cd C:\david\projects\petroinstall-web
#vagrant ssh

## instalar npm version 12
cd ~
#sudo apt-get purge --auto-remove nodejs
sudo apt-get install curl
curl -sL https://deb.nodesource.com/setup_12.x | sudo -E bash -
sudo apt-get install -y nodejs
node -v

## npm
wget https://npmjs.org/install.sh
sudo chmod +x install.sh
sudo ./install.sh

## petroinstal folder
cd /var/www/petroinstal

# create .env file as a copy of .env.example
sudo cp .env.example .env

# generate laravel appplication key
php artisan key:generate

# dependencias
composer update
composer dump-autoload
##npm cache clean --force
##npm cache verify
##npm i npm@latest -g
##npm install ionic -g
sudo npm install
npm run dev
php artisan migrate
php artisan db:seed --class=UsersAndTeamsSeeder
#php artisan innoinstall:install --devseed
#php artisan innoassets:install
#php artisan petroinstal:install --devseed
