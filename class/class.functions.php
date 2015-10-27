<?php
class CommonFunctions {
	public function __construct() {
	}

	public function sanitizeString($string) {
		$replace = array('!', '~', '`', '@', '#', '$', '%', '^', '&', '*', '*', '(', ')', '-', '_', '+', '=', '{', '}', ':', ';', "\"", "'", ",", "<", ">", "?", "/", ".", "|", "\\");
		$string = strtolower(str_replace($replace, " ", $string));
		$string = str_replace("  ", " ", $string);
		$string = str_replace(" ", "-", $string);
		return $string;
	}
}
?>
