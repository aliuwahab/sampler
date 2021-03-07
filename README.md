
## About This Project Laravel
A simple coding challenge required by sampler in the recruitment process.

## System Requirements
Make sure you have the following installed in your machine

1. PHP >= 7.4 || https://www.php.net/downloads.php
2. MySQL >=  8.0    || https://www.mysql.com/downloads/
3. Composer  || https://getcomposer.org/download/


## How to Set Up
1. cd into root of project and run `composer install`
2. Open your terminal and run `mysql -u root -p` (enter your password if it requires it as it depends), and run `CREATE DATABASE sampler_db;`
3. Find the `.env.example` file in the root of the project and save as `.env`
4. In the root of project run `php artisan migrate`
5. In the root of project run `php artisan db:seed`
6. In the root of the project run `php artisan serve`, it most likely will be running on: `http://127.0.0.1:8000` (or take note of the port is running on as that depends on the ports that are free on your system)



## License
Licensed under the [MIT license](https://opensource.org/licenses/MIT).
