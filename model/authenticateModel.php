<?php
require_once _CONST_CLASS_PATH . 'class.database.php';
require_once _CONST_CLASS_PATH . 'class.formrender.php';
class authenticateModel extends Database {

	public function __construct($siteId = NULL, $siteParams = array()) {
		parent::__construct();
	}

	private function loadUserSession($user_id, $password) {
		$this->_whereCondition = NULL;
		$this->_modelQuery = "SELECT cms_id, employee_id, employee_name, mail, designation, password FROM cms_users WHERE mail=:user_id";
		$this->query($this->_modelQuery);
		$this->bindByValue('user_id', $user_id);
		$this->_queryResult = $this->single();
		if (password_verify($password, $this->_queryResult['password'])) {
			$_SESSION['_loggedIn'] = 1;
			$_SESSION['_cmsId'] = base64_encode($this->_queryResult['cms_id']);
			$_SESSION['_employeeId'] = base64_encode($this->_queryResult['employee_id']);
			$_SESSION['_employeeName'] = base64_encode($this->_queryResult['employee_name']);
			$_SESSION['_mail'] = base64_encode($this->_queryResult['mail']);
			$_SESSION['_designation'] = base64_encode($this->_queryResult['designation']);
		}
	}

	private function verifyUserCredentials($_userId, $_Password) {
		$this->_modelQuery = "SELECT cms_id, mail, password FROM cms_users WHERE mail=:user_id";
		$this->query($this->_modelQuery);
		$this->bindByValue('user_id', $_userId);
		$this->_queryResult = $this->single();
		return password_verify($_Password, $this->_queryResult['password']);
	}

	protected function loginUser($_userId, $_Password) {
		/**
		 * check if the records exists into the DB
		 * if it exists register session else throw error
		 */
		if ($this->verifyUserCredentials($_userId, $_Password) == true) {
			/**
			 * Load User Session
			 */
			$this->loadUserSession($_userId, $_Password);
			return 'success';
		} else {
			$_SESSION['error'][] = "Invalid UserID or Password";
			return 'error';
		}
	}

	protected function logoutUser() {
		unset($_SESSION);
		session_destroy();
		return 'success';
		//echo json_encode($this->_details);
	}
}
?>
