<?php class Main extends Controller
{
    function __construct()
    {
    }

    function call()
    {
        Auth::require_auth();
        $view = new VMain;
        $view->render();
    }
}
