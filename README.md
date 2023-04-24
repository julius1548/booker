# Restaurant booking

## Installation

This application follows standard laravel installation procedure
### Install dependencies and setup .env
    composer install
    npm ci
    cp .env.example .env
    php artisan key:generate

Finally, setup `DATABASE_*` variables in the `.env` file.

### Adding initial data
Setup test restaurant and table settings run:

    php artisan db:seed
