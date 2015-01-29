<?php class vRegister extends view
{
    function view_body()
    { ?>
        <div class="top_panel" style="color: red; text-align: center;" id="warning"></div>
        <form class="form" onsubmit="return postData();">
            <div class="form_div">
                <label>Login: <input class="form_input" onkeyup="login_check()" type="text" name="login"
                                     autofocus></label>
                <label>Hasło: <input class="form_input" onchange="pass_check()" type="password" name="pass"></label>
                <label>Powtórz hasło: <input class="form_input" onkeyup="pass_check()" type="password" name="passr">
                </label>
            </div>
            <div class="form_div">
                <input type="submit" disabled="disabled" id="submit_btn" class="form_button" value="ZAREJESTRUJ">
            </div>
            <div class="form_div form_hint">Lub <a href="<?= $GLOBALS['mainFolder'] ?>/Auth">zaloguj</a> jeśli masz
                konto
            </div>
        </form>
        <script type="application/javascript" src="<?= $GLOBALS['mainFolder'] ?>/scripts/sha1.js"></script>
        <script type="text/javascript">
            var warningDiv = document.getElementById('warning');
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
                var login = document.getElementsByName('login')[0].value;
                enableSubmit({login: false});
                if (!login.match(/^[a-zA-Z]+[0-9]*$/)) {
                    warningDiv.innerText = 'Login musi zaczynać się literą i składać się wyłacznie z liter lub cyfr';
                    return;
                }
                if (login.length < 3) {
                    warningDiv.innerText = 'Login musi być dłuższy niż 3 znaki';
                    return;
                }
                var xmlhttp = getHTTPObject();
                xmlhttp.onreadystatechange = function () {
                    if (4 == xmlhttp.readyState) {
                        if (xmlhttp.responseText == 'available') {
                            enableSubmit({login: true});
                            warningDiv.innerText = '';
                        }
                        else {
                            enableSubmit({login: false});
                            warningDiv.innerText = 'Login zajęty';
                        }
                    }
                };
                xmlhttp.open('GET', '<?= $GLOBALS['mainFolder'] ?>/Register/check/' + login + '/', true);
                xmlhttp.send();
            }
            function pass_check() {
                enableSubmit({pass: false});
                var pass = document.getElementsByName('pass')[0].value;
                if (!pass.match(/(?=.*[0-9]+.*)(?=.*[a-z]+.*)(?=.*[A-Z]+.*)/) || pass < 5) {
                    warningDiv.innerText = 'Hasło się składać minimum z 5 znaków i posiadać minimum jedną cyfrę, małą i wielką literę';
                    return;
                }
                warningDiv.innerText = '';
                if (pass == document.getElementsByName('passr')[0].value) enableSubmit({pass: true});
                else warningDiv.innerText = 'Hasła nie zgadzają się';
            }
            function postData() {
                var login = document.getElementsByName('login')[0].value,
                    pass = document.getElementsByName('pass')[0].value,
                    a1 = CryptoJS.SHA1(CryptoJS.SHA1(login) + pass).toString(),
                    http = getHTTPObject(),
                    params = 'login=' + login + '&a1=' + a1;

                http.open('POST', '<?= $GLOBALS['mainFolder'] ?>/Register/post/', true);
                http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
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
                            default:
                                alert('Nierozpoznana odpowiedź serwera: ' + http.status);
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
