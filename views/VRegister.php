<?php class VRegister extends View
{
    function view_body()
    { ?>
        <form class="form" onsubmit="return postData();">
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
        <script type="application/javascript" src="<?= $GLOBALS['mainFolder'] ?>/scripts/sha1.js"></script>
        <script type="text/javascript">
            function enableSubmit(params) {
                if (params instanceof Object) {
                    if ('login' in params) enableSubmit.login = params.login;
                    if ('pass' in params) enableSubmit.pass = params.pass;
                }
                document.getElementById('submit_btn').disabled = !('login' in enableSubmit && enableSubmit.login &&
                                                                   'pass' in enableSubmit && enableSubmit.pass);
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
                    '<?= $GLOBALS['mainFolder'] ?>/Register/check/' + document.getElementsByName('login')[0].value +
                    '/',
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
                var login = document.getElementsByName('login')[0].value,
                    pass = document.getElementsByName('pass')[0].value,
                    a1 = CryptoJS.SHA1(CryptoJS.SHA1(login) + pass).toString(),
                    http = getHTTPObject(),
                    params = "login=" + login + "&a1=" + a1;

                http.open("POST", '<?= $GLOBALS['mainFolder'] ?>/Register/post/', true);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.onreadystatechange = function () {
                    if (http.readyState == 4) {
                        switch (http.status) {
                            case 200:
                                try {
                                    var json = JSON.parse(http.responseText);
                                    if ('location' in json) document.location = json.location;
                                } catch (e) {
                                }
                                break;
                            case 409:
                                //TODO username exist
                                break;
                            default:
                                alert("Nierozpoznana odpowiedź serwera: " + http.status);
                        }
                    }
                };
                http.send(params);

                return false;
            }
        </script>
    <?php
    }
}
