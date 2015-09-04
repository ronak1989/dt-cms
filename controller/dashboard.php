<?php
require_once _CONST_MODEL_PATH . $controller_name . 'Model.php';
class dashboard extends dashboardModel {

	private $_dashboardModel = NULL;

	private function redirect($status, $redirectUrl) {
		http_response_code($status);
		header("Location: " . $redirectUrl);
	}

	public function __construct($id = NULL, $params = array()) {
		$this->_dashboardModel = new dashboardModel();
	}

	public function loadDashboard() {
		require_once _CONST_VIEW_PATH . 'dashboard.tpl.php';
	}
}

?>
