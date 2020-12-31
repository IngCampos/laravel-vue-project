# Laravel Vue Intranet

_Intranet system to automate processes, show information, manage users and permissions._

### Project goal by martin-stepwolf :goal_net:

Personal project to show the skills I developed in my internship by building a similar project and improve it with other courses and better practices. 

### Achievements :star2:

As web developer, I knew already about PHP vanilla, Vue, databases, etc.
The challenge was create a professional project, where I achieved.

- Create databases, default and fake data with migrations, seeders and factories.
- Learn about MVC pattern and better practices.
- Create dynamic pages with Vue (JavaScript) using Axios as HTTP client.
- Manage the security, views, routes, model, controllers, etc as Laravel works.
- Use third party packages like vue-json-csv, vue-sweetalert2 and vue2-datepicker.

Then I take some courses and I improve the project with:

- Fix an admin template, where styles and some html elements are defined.
- Optimize some views by getting the data in the view(not by HTTP client).
- Backend validation in the request (app/Http/Request).
- Dynamic views with slug in the url.
- Cleaning and optimizing the code.

## Getting Started :rocket:

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites :clipboard:

The programs you need are:

-   [Composer](https://getcomposer.org/download/).
-   [Node.js](https://nodejs.org/en/download/).
-   Database and a web server with PHP.

### Installing 🔧

Duplicate the file .env.example as .env and set your credential for the database in.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=
```

Then install the PHP packages.

```
composer install
```

Generate the application key.

```
php artisan key:generate
```

Then create the symbolic link (from public/storage to storage/app/public).

```
php artisan storage:link
```

Then install the JavaScript packages with npm.

```
npm install
```

Finally generate the database with fake data:

```
php artisan migrate --seed
```

## Running the project :computer:

First generate the public files with

```
npm run dev
```

Note: Each time SASS and JavaScript files are updated you need to run the past command, to make it automated run:

```
npm run watch
```

Finally run the serve

```
php artisan serve
```

## Deployment 📦

To deploy the project you need extra configurations for optimization and security as:

Generate optimized JavaScript files.

```
npm run production
```

Set in the file .env the next configuration.

```
APP_ENV=production
```

## Built With 🛠️

-   [PHP 7.2.19](https://www.php.net/releases/7_2_19.php) - Backend language.
-   [Laravel 7](https://laravel.com/) - PHP framework.
-   [Vue 2](https://vuejs.org/) - JavaScript framework.
-   [Bootstrap 4](https://getbootstrap.com/docs/4.0/getting-started/introduction/) - CSS framework.
-   [SASS](https://sass-lang.com/) - CSS preprocessor. 
-   [SB Admin 2](https://startbootstrap.com/themes/sb-admin-2/) - Admin theme.

## Authors

-   Martín Campos [martin-stepwolf](https://github.com/martin-stepwolf)

## Contributing

You're free to contribute to this project by submitting [issues](https://github.com/martin-stepwolf/laravel-vue-intranet/issues) and/or [pull requests](https://github.com/martin-stepwolf/laravel-vue-intranet/pulls).

## License

This project is licensed under the [MIT License](https://choosealicense.com/licenses/mit/).

## References :books:

- [SASS course](https://platzi.com/clases/sass/)
- [PHP with Laravel](https://platzi.com/clases/curso-php-laravel/)
- [Vue.js basic course](https://platzi.com/clases/vuejs/)
- [Laravel introduction course](https://platzi.com/clases/curso-php-laravel/)