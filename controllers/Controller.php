<?php class Controller
{
    public function call($params)
    {
        if (!$params[0]) {
            if (method_exists($this, 'main')) {
                $this->main();
                return;
            }
        } else {
            if (method_exists($this, $params[0])) {
                $this->$params[0](array_slice($params, 1));
                return;
            }
        }
        Router::error404();
    }

    public function __construct()
    {
    }

}