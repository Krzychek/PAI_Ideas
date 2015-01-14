<?php class Login {
	function __construct() {}
	function check($param) {
		if($param[0] == "admin")
			echo false;
		else echo true;
	}
}?>
