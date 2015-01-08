<?php class VTest {
	private $string;
	function __construct($string) {
		$this->string = $string;
	}

	function render() {
		?>
		<!doctype html>
		<html>
		<head></head>
		<body>
			<h1><?php echo $this->string;?> </h1>
		</body>
		</html>
		<?php
	}
}?>
