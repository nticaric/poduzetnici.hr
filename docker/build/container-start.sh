#!/bin/bash

# Navigate to the Laravel application directory
cd /app

# Ensure storage directories exist and are writable
echo "Setting up storage directories..."
mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views
chmod -R 775 storage bootstrap/cache
touch storage/logs/laravel.log
chmod 664 storage/logs/laravel.log

# Run database migrations
echo "Running database migrations..."
php artisan migrate --force

# Clear and optimize Laravel cache
echo "Clearing and optimizing Laravel cache..."
php artisan optimize:clear
php artisan optimize

# Start supervisor (nginx + php-fpm)
echo "Starting services..."
exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
