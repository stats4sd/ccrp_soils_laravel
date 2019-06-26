# ccrp_soils_laravel

## Setup Development Environment

1. Clone project
2. `composer install && npm install`
2. `cp .env.example .env`
3. Update .env file with localhost details: 
    - APP_URL
    - DB_DATABASE
    - DB_USERNAME
    - DB_PASSWORD
4. Include Stats4SD Development environment details:
    - MAILGUN info

5. `php artisan key:generate`
6. `php artisan migrate:fresh --seed`