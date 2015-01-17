<?php class VRegister extends View
{
    function view_body()
    { ?>
        <form class="form" method='POST' action='/makeapp/Register/register/'>
            <div class="form_div">
                <label>Login: <input class="form_input" onkeyup="login_check()" type="text" name="login"></label>
                <label>Hasło: <input class="form_input" onkeyup="pass_check()" type="password" name="pass"></label>
                <label>Powtórz hasło: <input class="form_input" onkeyup="pass_check()" type="password"
                                             name="passr"></label>
            </div>
            <div class="form_div">
                <input type="submit" disabled="disabled" id="submit_btn" class="form_button" value="ZAREJESTRUJ">
            </div>
        </form>
        <script type="text/javascript">
            function enableSubmit(params) {
                if (params instanceof Object) {
                    if ('login' in params) enableSubmit.login = params.login;
                    if ('pass' in params) enableSubmit.pass = params.pass;
                }
                document.getElementById('submit_btn').disabled = !('login' in enableSubmit && enableSubmit.login && 'pass' in enableSubmit && enableSubmit.pass);
            }
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
            function login_check() {
                var xmlhttp = getHTTPObject();
                xmlhttp.onreadystatechange = function () {
                    if (4 == xmlhttp.readyState) {
                        if (xmlhttp.responseText == 'available') enableSubmit({login: true});
                        else enableSubmit({login: false});
                    }
                };
                xmlhttp.open('GET',
                    '/makeapp/Register/check/' + document.getElementsByName('login')[0].value + '/',
                    true);
                xmlhttp.send();
            }
            function pass_check() {
                var pass = document.getElementsByName('pass')[0].value;
                if (pass < 5) return;
                if (pass == document.getElementsByName('passr')[0].value) {
                    enableSubmit({pass: true});
                } else enableSubmit({pass: false});
            }
            function postData() {
                var login = document.getElementsByTagName('login')[0].value;
                var pass = document.getElementsByTagName('pass')[0].value;
            }
        </script>
    <?php
    }
}
