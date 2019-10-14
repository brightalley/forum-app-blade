# Forum App

Simple API project as a base for a forum app.

## Technologies

- Laravel
- React
- MySQL

## Requirements

- PHP 7.2+
- Composer
- MySQL
- Node 8+

## Installation

Make sure you have a database set up with valid credentials. Make a copy of
`.env.example` and name it `.env`, and fill in the values. In particular, pay
attention to `DB_*` and `APP_URL`. Note that Redis, AWS, Pusher etc. are currently
not used.

Run the following commands to get up and running:

- `composer install`
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`
- `php artisan storage:link`
- `npm install`
- `nmp run watch` (or `npm run dev` for a one-time build)

You may use `php artisan serve` as a development server.
