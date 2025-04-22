# Laravel User Last Access Tracker

A simple Laravel package to track the last login time of authenticated users. Automatically records the timestamp of each user login or request match.

## 📦 Installation

```bash
composer require ouredu/laravel-user-last-access

php artisan vendor:publish --tag=migrations
php artisan migrate

composer install
php artisan test
