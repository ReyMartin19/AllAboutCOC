#!/usr/bin/env bash

php artisan key:generate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
