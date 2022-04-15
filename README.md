# NMVC
NMVC is a PHP base MVC framework

## Installation

The NMVC can be installed with [Composer](https://getcomposer.org/).

```sh
composer create-project shafiul-islam/nmvc
```
## Directory Structure
```
nmvc
│   README.md
│   file001.txt    
│
└───app
│   │   bootstrap.php
│   │
│   └───components
│   └───config
│   └───core
│   └───models
│   └───routes
│   └───views
│
└───public
│   │
│   └───index.php
│
│
└───resource
 
```
## The Basics
### Routing
All route files are defined in `app/routes` directory
#### Web Routing
`routes/web.php` used for defines routes for application's interface.<br /><br />
here is a basic structure of web.php
```php
<?php
use app\core\App;
$app = new app();
//routes 
$app->run();
```
the most basic routing is closure aproch. it has 2 arguments. route uri as a string and a closure.
<br/>
<br/>
this route will work as a index page. example: `http://example.com/`
```php
$app->router->get('/',function (){
    echo 'Hello World!';
});
```
for `http://example.com/hello`
```php
$app->router->get('/hello',function (){
    echo 'Hello World!';
});
```
Router class (`$app->router`) has 2 methods right now. `GET`, and `POST`.
<br/>
POST route can be create by useing 
```php
$app->router->post();
```
route medthods also accept contoller as a callback argument. we can pass a array where 0 index will be the calss name, and 1 index will be the function name
```php

use app\controllers\Pages;

$app->router->post('/hello',[Pages::class,'hello']);
```
also we can we can define a view directly
```php
$app->router->get('/hello','hello');
```
#### API Routing
coming soon
