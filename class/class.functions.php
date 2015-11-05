<?php
class CommonFunctions {
	public function __construct() {
	}

	public function sanitizeString($string) {
		/*$replace = array('!', '~', '`', '@', '#', '$', '%', '^', '&', '*', '*', '(', ')', '-', '_', '+', '=', '{', '}', ':', ';', "\"", "'", ",", "<", ">", "?", "/", ".", "|", "\\");
		$string = strtolower(str_replace($replace, " ", trim($string)));
		$string = strtolower(str_replace($replace, "", trim($string)));
		$string = str_replace("  ", " ", trim($string));
		$string = str_replace(" ", "-", trim($string));*/
		$string = str_replace(' ', '-', strtolower(trim($string))); // Replaces all spaces with hyphens.
		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
		return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
	}
}
?>
