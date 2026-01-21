#!/bin/bash

# Navigate to the Laravel application directory
cd /app

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
