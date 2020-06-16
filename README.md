# ccrp_soils_laravel

1. If you haven't run this locally since April2020, do a fresh migration (`php artisan migrate:fresh`) as a lot of little things have changed in the database.

2. On localhost, also run the database seeds (`php artisan db:seed`) to have an admin user created automatically with the following details:
    Username: test@example.com
    Password: password

3. See below for setting up / testing the Jobs and local notifications.


## Setup Development Environment

1. Clone project
2. `composer install && npm install`
2. `cp .env.example .env`
3. Update .env file with required details
4. Include Stats4SD Development environment details:
    - MAILGUN info

5. `php artisan key:generate`
6. `php artisan migrate:fresh --seed`


### Run Laravel Websockets & Queues
To run the local notifications, start up Laravel Websockets locally: `php artisan websockets:serve`. This runs the websockets server on localhost port 6001.

To test the job queue locally, run Horizon: `php artisan horizon`.