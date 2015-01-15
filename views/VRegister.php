<?php class VRegister extends View {
	function __construct() {	}
	function view_body() { ?>
<?php include('top_panel.php'); ?>
	<form method='POST' action='/makeapp/Register/register/'>
		<label>Login: <input onkeyup="login_check()" type="text" name="login"></label>
		<label>Hasło: <input onkeyup="pass_check()" type="text" name="pass"></label>
		<label>Powtórz hasło: <input onkeyup="pass_check()" type="text" name="passr"></label>
		<input type="submit" id="submit_btn"> // TODO

		<script type="text/javascript">
			function get_XmlHttp() {
				var xmlHttp = null;
				if(window.XMLHttpRequest)
					xmlHttp = new XMLHttpRequest()
				else if(window.ActiveXObject)
					xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
				return xmlHttp;
			}
			function pass_check() {
				document.getElementById("submit_btn").disabled = true;
				var login = document.getElementsByName("login")[0].value;
				var xmlhttp = get_XmlHttp();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState = 4) {
						if (xmlhttp.responseText == 1)
							document.getElementById("submit_btn").disabled = false;
						else
							document.getElementById("submit_btn").disabled = true;
					}
				}
				xmlhttp.open("GET","/makeapp/Register/check/" + login + "/", true);
				xmlhttp.send();
				document.getElementById("submit_btn").disabled = true;
				var pass = document.getElementsByName("pass")[0].value;
				var passr = document.getElementsByName("passr")[0].value;
				if (passr == pass)
					document.getElementById("submit_btn").disabled = false;
				else
					document.getElementById("submit_btn").disabled = true;
			}
			function get_XmlHttp() {
				var xmlHttp = null;
				if(window.XMLHttpRequest)
					xmlHttp = new XMLHttpRequest()
				else if(window.ActiveXObject)
					xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
				return xmlHttp;
			}
			function postData() {
				var login = document.getElementsByTagName('login')[0].value;
				var pass = document.getElementsByTagName('pass')[0].value;
			}
		</script>
	</form>
<?php
	}
}?>
