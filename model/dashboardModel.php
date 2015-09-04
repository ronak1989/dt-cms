<?php
require_once _CONST_CLASS_PATH . 'class.database.php';
require_once _CONST_CLASS_PATH . 'class.formrender.php';
class dashboardModel extends Database {

	public function __construct($siteId = NULL, $siteParams = array()) {
		parent::__construct();
	}
}
?>
