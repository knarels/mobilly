#!/bin/bash
set -e

echo "🕒 Waiting for MySQL to be ready..."
until mysqladmin ping -h"$DB_HOST" --silent; do
  sleep 1
done

echo "✅ MySQL is up – running Symfony commands..."

# Composer dependencies
composer install --no-interaction

# Run migrations
php bin/console doctrine:migrations:migrate --no-interaction

# Import stations
php bin/console app:import-meteorology-stations

# Start Symfony dev server
exec php -S 0.0.0.0:8000 -t public
