# simple-mvc-with-php

```sh
composer require facebook/graph-sdk
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
