# Laravel Vue Intranet ![Status](https://img.shields.io/badge/status-in_proccess-orange) ![Passing](https://img.shields.io/badge/build-no_passing-orange) ![Docker build](https://img.shields.io/badge/docker_build-passing-green)

_Intranet system to automate processes, show information, manage users and permissions._

### Project goal by martin-stepwolf :goal_net:

Project where I started to practice and improve my knowledge in Laravel. Many features was implemented based on past scholar projects and some courses I have made.

**Note:** Much technical debt was generated due to not use testing at the beginning and not follow good practices. Many hours I spent in checking the application in the browser and debugging unknown and known errors, so there are some errors and I have try to implemented some test. 

### Achievements :star2:

- Improved my knowledge about Laravel.
- Implemented functionalities about permissions - resource in users.
- Implemented security in view for users that does not have an specific permission.
- Backend validation in the request (app/Http/Request).
- Implemented dynamic views with slug in the url.

- Fixed an admin template (with knowledge in SASS), where styles and some html elements are defined.
- Implemented dynamic views with Vue.js and Axios.
- Used third party packages like vue-json-csv (to download data in csv format), vue-sweetalert2 (to have nice messages) and vue2-datepicker (to select a range of dates).

- Implemented docker compose for a better environment.
- Implemented some test with PHPUnit.

---

## Getting Started :rocket:

These instructions will get you a copy of the project up and running on your local machine.

### Prerequisites :clipboard:

The programs you need are:

-   [Docker](https://www.docker.com/get-started).
-   [Docker compose](https://docs.docker.com/compose/install/).

### Installing 🔧

First duplicate the file .env.example as .env.

```
cp .env.example .env
```

Note: You could change some values, anyway docker-compose create the database according to the defined values.

Create the image (php:7.4-composer-npm) and run the services (php, nginx and mysql):

```
docker-compose up
```

Note: The next steps can be automated bu running

```
sh install.sh
```

Then install the dependencies.

```
docker-compose exec app composer install
docker-compose exec app npm install
```

Then generate the application key.

```
docker-compose exec app php artisan key:generate
```

Create the symbolic link (from public/storage to storage/app/public).

```
docker-compose exec app php artisan storage:link
```

Finally generate the database with fake data:

```
docker-compose exec app php artisan migrate --seed
```

Note: You could refresh the database any time with `migrate:refresh`.

---

## Running the project :computer:

### JavaScript and CSS files.

Each time SASS and JavaScript files are updated you need to run:

```
docker-compose exec app npm run dev
```

To make it automated run:

```
docker-compose exec app npm run watch
```

And now you have all the environment, the nginx server is in the port 8000 (e.g http://127.0.0.1:8000/).

---

## Testing

### Backend testing

There are few testing in main controllers and models, you can run it with. 

```
docker-compose exec app php artisan test
```

## Built With 🛠️

-   [PHP 7.4](https://www.php.net/releases/7_4_0.php) - Backend language.
-   [Laravel 7](https://laravel.com/docs/7.x/releases/) - PHP framework.
-   [Vue 2](https://vuejs.org/) - JavaScript framework.
-   [Bootstrap 4](https://getbootstrap.com/docs/4.0/getting-started/introduction/) - CSS framework.
-   [SASS](https://sass-lang.com/) - CSS preprocessor. 
-   [SB Admin 2](https://startbootstrap.com/themes/sb-admin-2/) - Admin theme.

---

### Authors

- Martín Campos - [martin-stepwolf](https://github.com/martin-stepwolf)

### Contributing

You're free to contribute to this project by submitting [issues](https://github.com/martin-stepwolf/laravel-vue-intranet/issues) and/or [pull requests](https://github.com/martin-stepwolf/laravel-vue-intranet/pulls).

### License

This project is licensed under the [MIT License](https://choosealicense.com/licenses/mit/).

### References :books:

- [Tutorial Laravel with Docker Compose](https://www.digitalocean.com/community/tutorials/how-to-install-and-set-up-laravel-with-docker-compose-on-ubuntu-20-04)
- [Docker course](https://platzi.com/clases/docker/)
- [SASS course](https://platzi.com/clases/sass/)
- [PHP with Laravel](https://platzi.com/clases/curso-php-laravel/)
- [Vue.js basic course](https://platzi.com/clases/vuejs/)
- [Laravel introduction course](https://platzi.com/clases/curso-php-laravel/)
