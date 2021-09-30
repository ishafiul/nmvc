# simple-mvc-with-php(NMVC)
The NMVC can be installed with [Composer]. Run this command:
```sh
composer create-project shafiul-islam/nmvc
```

# config:
## path
you need to change path, before deploy. you can find it from 
###### app->config->config.php

here you need to chang your url root and document root patha.

another change for path is 

###### RewriteBase /mvc/public

if you want to live you site then keep only /public


## .ENv
there is a file called .env.example in root directry. remame it to just .env.

## database 
###### mysql

inside .env file you will find 
DB_HOST=
DB_USER=
DB_PASS=
DB_NAME=

set your db info here 

ex:
DB_HOST=localhost
DB_USER=root
DB_PASS=123
DB_NAME=test
## controller
you can crete contoller class inside 
###### app->controllers->
###### example:
```sh
<?php
class Pages extends Controller {
    public function __construct(){
    }

    public function index()
    {// function name will define what will be the page url that user will input

        $this->view('pages/index'); // which view will load
    }
}
```
