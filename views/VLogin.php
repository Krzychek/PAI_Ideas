<?php class VLogin extends View
{
    function view_body()
    {
        ?>
        <script type="application/javascript">
            function getHTTPObject() {
                if (typeof XMLHttpRequest != 'undefined') return new XMLHttpRequest();
                try {
                    return new ActiveXObject('Msxml2.XMLHTTP');
                } catch (e) {
                    try {
                        return new ActiveXObject('Microsoft.XMLHTTP');
                    } catch (e) {
                    }
                }
                return false;
            }
            function doLogin() {
                var http = getHTTPObject();
                var username = document.getElementById('login-username').value;
                var password = document.getElementById('login-password').value;
                http.open("get", '/makeapp/Auth/dologin/', false, username, password);
                http.send("");
                if (http.status == 200) {
                    document.location = '/makeapp/Ideas';
                } else {
                    alert("Incorrect username and/or password.");
                }
                return false;
            }
        </script>
        <div class="form">
            <form onsubmit="return doLogin()">
                <div class="form_div">
                    <label>Login: <input type=text id="login-username" class="form_input" name="login"></label>
                    <label>Hasło: <input type=password id="login-password" class="form_input" name="password"></label>
                </div>
                <div class="form_div">
                    <input type=submit value="ZALOGUJ" class="form_button">
                </div>
            </form>
        </div>
    <?php
    }
}
