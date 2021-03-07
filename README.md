
## About This Project
A simple coding challenge administered

## System Requirements
Make sure you have the following installed in your machine

1. PHP >= 7.4 (https://www.php.net/downloads.php)
2. MySQL >=  8.0    (https://www.mysql.com/downloads/)
3. Composer  (https://getcomposer.org/download)
4. Download Postman  (https://www.postman.com/downloads)


## How to Set Up
1. cd into root of project and run `composer install`
2. Open your terminal and run `mysql -u root -p` (enter your password if it requires it as it depends), and run `CREATE DATABASE sampler_db;`
3. Find the `.env.example` file in the root of the project and save as `.env`
4. In the root of project run `php artisan migrate`
5. In the root of project run `php artisan db:seed`
6. In the root of the project run `php artisan serve`, it most likely will be running on: `http://127.0.0.1:8000` (but take note of the port is running on as that depends on the ports that are free on your system)


## API Endpoints (Postman Collection)
1. Make sure postman app is install
2. Copy this URL: https://www.getpostman.com/collections/b687ef1cfb05d8f1c01b
3. Goto your postman top menu. Click the `File` Tab, Select Import, On the 
4. Select `Import`
4. Select `Link` and past the link in point `2`
5. Click on the Collection that you just imported, it is name `Sampler`
6. Click the `Variables` tab
7. Set the current value for the variables `BASE_URL`, gotten from `php artisan serve`
8. Set the current value for `token`, gotten from login endpoint after you successfully login a user. You can create a user or check the DB to get on one of the seeded users and the password is always `secret`. Example of token is


## License
Licensed under the [MIT license](https://opensource.org/licenses/MIT).
