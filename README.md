# PHP MVC Boilerplate

## Installation

First execute below commands

```
git clone <Git URL>
cd <carpeta el proyecto>
composer install
bower install
```

## Setup Database

First create a database and update the database credentials in `app/service.php`

## Create Schema

Execute below command inside the project folder

```
php vendor/bin/doctrine orm:schema-tool:create
```

## That's all folks

Important: Make sure the Document Root is set to the `public` folder before you navigate to your Mamp/Wamp server, e.g. `http://php-mvc.local:8888`

If you haven't installed Mamp/Wamp server, you might want to use PHP's built-in web server using the following command:

```
php -S localhost:8888 -t public
```
