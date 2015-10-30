<?php
class CommonFunctions {
	public function __construct() {
	}

	public function sanitizeString($string) {
		$replace = array('!', '~', '`', '@', '#', '$', '%', '^', '&', '*', '*', '(', ')', '-', '_', '+', '=', '{', '}', ':', ';', "\"", "'", ",", "<", ">", "?", "/", ".", "|", "\\");
		$string = strtolower(str_replace($replace, " ", trim($string)));
		$string = str_replace("  ", " ", trim($string));
		$string = str_replace(" ", "-", trim($string));
		return $string;
	}
}
?>
