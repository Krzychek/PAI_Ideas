<?php class vLogin extends view
{
    private $message;

    function __construct($message = null)
    {
        $this->message = $message;
    }

    function view_body()
    {
        if ($this->message) { ?>
            <div class="content">
                <div class="major_section" style="text-align: center"><?= $this->message ?></div>
            </div>
        <?php } ?>
        <div class="top_panel" style="color: red; text-align: center;" id="warning"></div>
        <div class="form">
            <form method="post" onsubmit="return doLogin()">
                <div class="form_div">
                    <label>Login: <input type=text id="login-username" class="form_input" name="login"
                                         autofocus></label>
                    <label>Hasło: <input type=password id="login-password" class="form_input" name="password"></label>
                </div>
                <div class="form_div">
                    <input type=submit value="ZALOGUJ" class="form_button">
                </div>
            </form>
        </div>

        <script type="application/javascript" src="<?= $GLOBALS['mainFolder'] ?>/scripts/sha1.js"></script>
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
                var http = getHTTPObject(),
                    username = document.getElementById('login-username').value,
                    password = document.getElementById('login-password').value,
                    nonce;
                http.open("GET", '<?= $GLOBALS['mainFolder'] ?>/Auth/getnonce/' + username, true);
                http.onreadystatechange = function () {
                    if (http.readyState == 4) {
                        if (http.status == 200) {
                            var innerhttp = getHTTPObject();
                            nonce = http.responseText;
                            var params = "login=" + username + "&auth=" +
                                         CryptoJS.SHA1(CryptoJS.SHA1(CryptoJS.SHA1(username) + password) + nonce);
                            innerhttp.open("POST", '<?= $GLOBALS['mainFolder'] ?>/Auth/dologin/', true);
                            innerhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            innerhttp.onreadystatechange = function () {
                                if (http.readyState == 4) {
                                    try {
                                        var json = JSON.parse(innerhttp.responseText);
                                        if ('location' in json) document.location = json.location;
                                        return;
                                    } catch (e) {
                                    }
                                    document.getElementById('warning').innerText = 'Niepoprawny login lub ' +
                                                                                   'hasło, spróbuj ponownie';
                                }
                            };
                            innerhttp.send(params);
                        }
                    }
                };
                http.send(null);


                return false;
            }
        </script>
    <?php
    }
}
