<?php class Login extends Controller
{
    function dologin()
    {
        Auth::check_auth();
    }

    function call()
    {
        $view = new VLogin;
        $view->render();
    }

    function logout()
    { ?>
        <script type="application/javascript">
            var http;
            if (typeof XMLHttpRequest != 'undefined') http = new XMLHttpRequest();
            try {
                http = new ActiveXObject('Msxml2.XMLHTTP');
            } catch (e) {
                try {
                    http =  new ActiveXObject('Microsoft.XMLHTTP');
                } catch (e) {
                }
            }
            http.open("get", '/makeapp/Login/dologin/', false, ' ', ' ');
            http.send("");
        </script>
    <?php
    }
}
