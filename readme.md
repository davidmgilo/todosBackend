# API TODOSBackend David Martinez

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/davidmgilo/todosBackend/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/davidmgilo/todosBackend/?branch=master)
[![Build Status](https://travis-ci.org/davidmgilo/todosBackend.svg?branch=master)](https://travis-ci.org/davidmgilo/todosBackend)
[![StyleCI](https://styleci.io/repos/71568846/shield?branch=master)](https://styleci.io/repos/71568846)
[![Code Coverage](https://scrutinizer-ci.com/g/davidmgilo/todosBackend/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/davidmgilo/todosBackend/?branch=master)

Respository of an API that implements CRUD operations of todos and users.

FrontEnd project with vue.js.

##Installation

Clone the repository via github:

```
$ git clone https://github.com/davidmgilo/todosBackend.git
```

Install the dependencies:

```
$ composer install
```

```
$ npm install
```

Set up the environment:

```
$ cp .env.example .env
```

Decomment the variable DB_CONNECTION and set it to sqlite.

Create the database:

```
$ touch database/database.sqlite
 ```
Generate the artisan key:

```
$ php artisan key:generate
```

Generate the passport keys:

```
$ php artisan passport:keys
```

##Usage

You can set up the database through:

```
$ php artisan migrate --seed
```

Use it through a local server as in:

```
$ llum serve
```

Or:

```
$ php artisan serve
```

## Testing

Through PHPUnit:

```
$ phpunit
```

## Contact

By email: davidmgilo@gmail.com


