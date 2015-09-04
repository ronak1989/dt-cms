<?php
require_once _CONST_MODEL_PATH . $controller_name . 'Model.php';
class authenticate extends authenticateModel {

	private $_authenticateModel = NULL;
	private $_loginUserid = NULL;
	private $_loginPassword = NULL;
	private $_resetUserId = NULL;
	private $_status = NULL;

	private function redirect($status, $redirectUrl) {
		http_response_code($status);
		header("Location: " . $redirectUrl);
	}

	public function __construct($id = NULL, $params = array()) {
		$this->_authenticateModel = new authenticateModel();
		$this->_loginUserid = isset($_POST['login_userid']) ? $_POST['login_userid'] : NULL;
		$this->_loginPassword = isset($_POST['login_password']) ? $_POST['login_password'] : NULL;
		$this->_resetUserId = isset($_POST['reset_userid']) ? $_POST['reset_userid'] : NULL;
	}

	public function showLoginBox() {
		require_once _CONST_VIEW_PATH . 'login.php';
	}

	public function logout() {
		$this->_status = $this->_authenticateModel->logoutUser();
		$this->redirect(303, _CONST_WEB_URL . '/login');
	}

	public function signin() {
		$this->_status = $this->_authenticateModel->loginUser($this->_loginUserid, $this->_loginPassword);
		if ($this->_status == 'success') {
			$this->redirect(303, _CONST_WEB_URL);
		} else {
			$this->redirect(303, _CONST_WEB_URL . '/login');
		}
	}
}

?>
