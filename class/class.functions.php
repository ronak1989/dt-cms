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

	public function humanTiming($time) {

		$time = time() - $time; // to get the time since that moment
		$time = ($time < 1) ? 1 : $time;
		$tokens = array(
			31536000 => 'year',
			2592000 => 'month',
			604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'minute',
			1 => 'second',
		);

		foreach ($tokens as $unit => $text) {
			if ($time < $unit) {
				continue;
			}

			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
		}

	}
}
?>
