# How to run this project

*git clone and then open the project directory, open your terminal and run all the steps below:*

1. `cp .env.example .env`
2. open `.env` and setup your database username and password
3. run `php artisan key:generate`
4. run `php artisan migrate`
5. run `php artisan db:seed --class=TodolistSeeder`
6. run `php artisan serve`
7. finish :D
