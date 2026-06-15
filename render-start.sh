#!/bin/bash
set -e

# Run package discovery (skipped during docker build)
echo "Discovering packages..."
php artisan package:discover --ansi

# Cache configuration for production
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations
echo "Running migrations..."
php artisan migrate --force

# Start Apache in the foreground
echo "Starting Apache..."
exec apache2-foreground
