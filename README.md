# Laravel Vue Project

_Personal project made with Laravel(PHP), Vue.js and Bootstrap as main frameworks._

_The goal of the project is the automatization of processes in a generic company._

## Getting Started 🚀

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites 📋

The programs you need are:

-   Browser (preferably Google Chrome because the Vue tools extension).
-   Database and database manager(preferably [Laragon](https://laragon.org/) because it also included a PHP server).
-   [Git bash](https://git-scm.com/downloads) and/or [GitHub Desktop](https://desktop.github.com/) to clonate the project and its monitoration.

For developing is recommendable [Visual studio code](https://code.visualstudio.com/).

Now we proceed to install the package handlers for PHP and JavaScript:

-   [Composer](https://getcomposer.org/download/).
-   [Node.js](https://nodejs.org/en/download/).

### Installing 🔧

First duplicate the file .env.example with the name .env in order to type the application data and database configuration. The following example shows default data by laragon.

```
APP_NAME='name'
APP_ENV=local
APP_KEY=base64:
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
```

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=
```

Then install the PHP packages with composer on the command line.

```
composer install
```

Now generate the application key.

```
php artisan key:generate
```

Then install the JavaScript packages with npm on the command line.

```
npm install
```

To confirm the instalation of the packages, the project should have the folders vendors and nodemodules.

Now generate the database with false data:

```
php artisan migrate --seed
```

## Running the tests ⚙️

To run the project in our computer for testing, first generate the public files that browsers will read with

```
npm run dev
```

Next run the serve with

```
php artisan serve
```

Then, open the browser with the address indicated by the command(http://127.0.0.1:8000 by default).

### Break down into end to end tests 🔩

The database could be restared with

```
php artisan migrate:refresh --seed
```

In the developing, when a Javascript, Vue or Sass file is modificated, it is necessary to run the command in order to process the files that the developer will read

```
npm run dev
```

However, the following command can be used in order to process the files automatically when there is any modification

```
npm run watch
```

_Note: It is recommended having 3 terminals in Visual Studio Code, the first one with the 'php artisan serve' command, the second one with 'npm run watch' and the third one for any other specific command(php artisan, npm, git, etc.)._

## Deployment 📦

To deploy the project to a production server, this needs to have the main programs shown in Prerequisites, then make certain adjustments for files optimization and security.

First optimize JavaScript and CSS files with:

```
npm run production
```

Then edit the file .env like the next example.

```
APP_NAME='name'
APP_ENV=production
APP_KEY=base64:
APP_DEBUG=false
APP_URL=https://www.domain.com
```

For the database, is recommended to have a strong password for the user of the database, this user needs its appropriate permissions. The next example has some data(first three) by default in a cPanel with PhpMyAdmin.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=name_database
DB_USERNAME=name_user
DB_PASSWORD=password
```

Next generate the key

```
php artisan key:generate
```

Now generate the database

```
php artisan migrate:refresh --seed
```

Finally run the server

```
php artisan run serve
```

## Built With 🛠️

-   [Laravel](https://laravel.com/) - Framework PHP.
-   [Vue.js](https://vuejs.org/) - Framework JavaScript.
-   [SB Admin 2](https://startbootstrap.com/themes/sb-admin-2/) - Admin theme.

In order to look about the specific libraries used, look the files package.json and composer.json

---

## Authors

-   Martín Campos - _Initial work_ [IngCampos](https://github.com/IngCampos)

## License

This project is licensed under the [MIT License](https://choosealicense.com/licenses/mit/).

Made with ❤️ by [Código Caliente](https://github.com/codigocaliente)

<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
