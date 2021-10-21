<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Requirements 

- MySQL Database. [Example docker image](https://hub.docker.com/r/linuxserver/mariadb)
- Local Development Server. [WAMP](https://www.wampserver.com/en/) or [XAMPP](https://www.apachefriends.org/index.html)
- [Composer (PHP Dependency Manager)](https://getcomposer.org/)
- [Nodejs](https://nodejs.org/en/)

## Installation

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

        php artisan migrate:fresh
        php artisan db:seed

- Install npm dependencies

        npm install

- Bring up project

        php artisan serve
        npm run dev
