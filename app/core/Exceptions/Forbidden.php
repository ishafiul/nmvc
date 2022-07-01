<?php

namespace app\core\Exceptions;

class Forbidden extends \Exception
{
    protected $message = 'You don\'t have permission to access this page';
    protected $code = 403;
}