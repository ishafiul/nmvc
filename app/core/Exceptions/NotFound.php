<?php

namespace app\core\Exceptions;

class NotFound extends \Exception
{
    protected $message = 'Page Not Found';
    protected $code = 404;
}