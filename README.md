<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Requirements 

- MySQL Database. [Example docker image](https://hub.docker.com/_/mariadb)
- Local Development Server. [WAMP](https://www.wampserver.com/en/) or [XAMPP](https://www.apachefriends.org/index.html)
- [Composer (PHP Dependency Manager)](https://getcomposer.org/)
- [Nodejs](https://nodejs.org/en/)

## Main Dependencies

- Vue.js
  - [World Map Vue](https://www.npmjs.com/package/world-map-vue)
  - [vue-axios](https://www.npmjs.com/package/vue-axios)
  - [vue-router](https://router.vuejs.org/)
- Laravel
  - [Guzzle](https://github.com/guzzle/guzzle)
  - [Laravel UI](https://github.com/laravel/ui)
  - (Optional) [sail](https://github.com/laravel/sail)

## Installation

Follow these steps to set up your local development. To quickly run as docker containers please see the [sail section](#optional-run-in-docker-container-with-sail)

- Install Laraval dependencies

      composer install

- Copy .env file
        
      cp .env.example .env

- Generate API Key
        
      php artisan key:generate

- Update database details in **.env** file
   
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=covid_tracker
      DB_USERNAME=root
      DB_PASSWORD=

- (Optional) Setup MySQL database through docker ([linuxserver/mariadb](https://hub.docker.com/r/linuxserver/mariadb))

      docker run -d \
      --name=mariadb \
      -e MYSQL_ROOT_PASSWORD=ROOT_ACCESS_PASSWORD \
      -e TZ=Asia/Kuwait \
      -e MYSQL_DATABASE=USER_DB_NAME `#optional` \
      -e MYSQL_USER=MYSQL_USER `#optional` \
      -e MYSQL_PASSWORD=DATABASE_PASSWORD `#optional` \
      -p 3306:3306 \
      -v path_to_data:/config \
      --restart unless-stopped \
      lscr.io/linuxserver/mariadb

- Migrate database and seed table(s)

      php artisan migrate --seed

- Install npm dependencies

      npm install

- Bring up project

      php artisan serve
      npm run dev

- Access http://localhost if *APP_PORT* has not been modified in **.env** file

## (Optional) Run in Docker container with Sail

- If sail has not been installed as part of the project

      composer require laravel/sail --dev
      php artisan sail:install #Installs the docker-compose.yml to root of the directory

- Bring up the docker containers through sail (Note: on Windows command should be run through WSL terminal to work)

      ./vendor/bin/sail up

- Once containers are up and running begin DB migration and seeding (Note: on Windows command should be run through WSL terminal to work)

      ./vendor/bin/sail artisan migrate --seed
