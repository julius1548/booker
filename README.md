# Restaurant booking

## Installation

This application follows standard laravel installation procedure
### Install dependencies, setup .env and database:
    composer install
    npm ci
    cp .env.example .env
    php artisan key:generate
    npm run build

Finally, setup `DB_*` variables in the `.env` file and run:
    
    php artisan migrate

### Adding initial data
Setup test restaurant and table settings run:

    php artisan db:seed

To add different data you can edit `database/seeders/TestDataSeeder.php` and run the seed command again.
