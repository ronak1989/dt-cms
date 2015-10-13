<?php
require_once _CONST_CLASS_PATH . 'class.database.php';
class ValidationModel extends Database {

	private $_modelQuery = '';
	private $_queryResult = '';
	private $_returnStatus = '';

	public function __construct($cruidId = NULL, $params = array()) {
		parent::__construct();
	}

	private function checkUseridExists($userid) {
		$this->_modelQuery = 'select count(1) as cnt from users where user_id=:userid';
		$this->query($this->_modelQuery);
		$this->bindByValue('userid', $userid);
		$this->_queryResult = $this->single();
		if ($this->_queryResult['cnt'] == 0) {
			return array('valid' => true);
		} else {
			return array('valid' => false);
		}
	}

	protected function validateUser($fieldName, $searchVal) {
		switch ($fieldName) {
			case 'userid':
				$this->_returnStatus = $this->checkUseridExists($searchVal);
				break;
		}
		return $this->_returnStatus;
	}
}
?>
