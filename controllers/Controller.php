<?php class Controller
{
    public function call($params) {
        $this->$params[0](array_slice($params,1));
    }
    public function __construct()
    {
    }
}