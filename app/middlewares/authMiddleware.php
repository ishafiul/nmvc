<?php
namespace app\middlewares;
use app\core\App;
use app\core\Middleware;
use app\core\Exceptions\Forbidden;

class authMiddleware extends Middleware {

    protected array $actions = [];
    private Forbidden $exception;

    public function __construct($actions = [])
    {
        $this->actions = $actions;
        $this->exception= new Forbidden();
    }

    /**
     * @throws Forbidden
     */
    public function execute()
    {
        if (empty($this->actions) || in_array(App::$app->action,$this->actions)){
            throw $this->exception;
        }
    }

}