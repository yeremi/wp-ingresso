#!/bin/bash

echo "Running composer"
composer install --no-ansi --no-dev --no-interaction --no-plugins --no-progress --no-scripts --optimize-autoloader

echo "Running i18n make-pot"
wp i18n make-pot . languages/wp-ingresso.pot

echo "Running webpack --mode production"
NODE_ENV=production webpack --mode production

echo "Running tailwindcss"
tailwindcss -i ./resources/scss/frontend.scss -o ./assets/css/wp-ingresso-styles.min.css --minify

echo "Running wp-scripts plugin-zip"
wp-scripts plugin-zip
