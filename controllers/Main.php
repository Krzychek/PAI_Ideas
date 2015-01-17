<?php class Main extends Controller
{
    function __construct()
    {
    }

    function call()
    {
        Auth::check_auth();
        $view = new VMain;
        $view->render();
    }
}
