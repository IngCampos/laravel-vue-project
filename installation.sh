# Script to automate the installation process

# Install PHP dependencies
docker-compose exec app composer install
# Install JavaScript dependencies
docker-compose exec app npm install
# Generate the security key (storaged in .env)
docker-compose exec app php artisan key:generate
# Create the symbolic link (from public/storage to storage/app/public).
docker-compose exec app php artisan storage:link
# Create the tables and fake data in the database
docker-compose exec app php artisan migrate --seed
# Generate the JavaScript and CSS files from Vue and SASS files
docker-compose exec app npm run dev
