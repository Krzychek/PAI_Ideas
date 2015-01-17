<?php class Main extends Controller
{
    function __construct()
    {
    }

    function call()
    {
        $view = new VMain;
        $view->render();
    }
}
