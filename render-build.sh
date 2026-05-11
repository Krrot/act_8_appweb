#!/usr/bin/env bash
# exit on error
set -o errexit

composer install --no-dev --no-interaction --prefer-dist

# Run migrations
php artisan migrate --force

# Seed database if requested
if [ "$RUN_SEEDERS" = "true" ]; then
    php artisan db:seed --force
fi

# Link storage
php artisan storage:link

# Clear and cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache
