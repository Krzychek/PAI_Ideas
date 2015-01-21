<div class="top_panel">
    <ul class="main_menu">
        <li><a href="<?= $GLOBALS['mainFolder'] ?>/ideas">MakeApp!</a></li>
        <li style="float: right;"><a onclick="logout()" class="switch"> wyloguj </a>
            <a class="switch">
                Zalogowano jako: <?= $GLOBALS['user_id'] ?>
            </a>
        </li>
    </ul>
    <script>
        function logout() {
            var http;
            if (typeof XMLHttpRequest != 'undefined') http = new XMLHttpRequest();
            else {
                try {
                    http = new ActiveXObject('Msxml2.XMLHTTP');
                } catch (e) {
                    http = new ActiveXObject('Microsoft.XMLHTTP');
                }
            }
            http.open("get", '<?= $GLOBALS['mainFolder'] ?>/Auth/dologin/', false, ' ', ' ');
            http.send("");
        }
    </script>
</div>
