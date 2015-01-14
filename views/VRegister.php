<?php class VRegister extends View {
	private $string;
	function __construct() {	}
	function render() {
		$this->get_header(); ?>
<body>
	<?php include('views/parts/top_panel.php'); ?>
</body>
<form method='POST' action='/makeapp/add/leader.php'>
	<label>Login: <input onkeyup="login_check()" type="text" name="login"></label>
	<label>Hasło: <input onkeyup="pass_check()" type="text" name="pass"></label>
	<label>Powtórz hasło: <input onkeyup="pass_check()" type="text" name="passr"></label>
	<input type="submit" id="submit_btn">
	<script type="text/javascript">
		function pass_check() {
			var pass = document.getElementsByName("pass")[0].value;
			var passr = document.getElementsByName("passr")[0].value;
			if (passr == pass) {
				document.getElementById("submit_btn").disabled = true;
			} else {
				document.getElementById("submit_btn").disabled = false;
			}
		}
		function login_check() {
			document.getElementById("submit_btn").disabled = true;
			var login = document.getElementsByName("login")[0].value;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState = 4) {
					if (xmlhttp.responseText == 1) {
						document.getElementById("submit_btn").disabled = false;
					} else {
						document.getElementById("submit_btn").disabled = true;
					}
				}
			}
			xmlhttp.open("GET","/makeapp/Login/Check/" + login + "/", true);
			xmlhttp.send();
		}
	</script>
</form>

</html>
<?php
	}
}?>
