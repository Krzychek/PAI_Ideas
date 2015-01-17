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
                http.open("get", '/makeapp/Login/dologin/', false, username, password);
                http.send("");
                if (http.status == 200) {
                    document.location = '/makeapp/';
                } else {
                    alert("Incorrect username and/or password.");
                }
                return false;
            }
        </script>
        <div class="login_form_wrapper">
            <div class="login_form">
                <form onsubmit="return doLogin()">
                    <div class="login_column">
                        <!--					TODO: delete divs! -->
                        <div class="form_div">
                            <label>Login: <input type=text id="login-username" class="login" name="login"></label>
                        </div>
                        <div class="form_div">
                            <label>Hasło: <input type=password id="login-password" class="pass" name="password"></label>
                        </div>
                    </div>
                    <div class="login_column">
                        <div class="form_div">
                            <input type=submit value="&#10003;" class="login_button">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php
    }
}
