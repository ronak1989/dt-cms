<?php
require_once _CONST_MODEL_PATH . $controller_name . 'Model.php';
class Validation extends ValidationModel {
	private $access_roles = array();
	private $_validationModel = NULL;
	private $_type = NULL;
	private $_returnType = 'json';
	private $_validate = NULL;
	private $_search = NULL;
	private $_validationResult = NULL;

	public function __construct($id = NULL, $params = array()) {
		$this->_validationModel = new validationModel(NULL, NULL);
		if (isset($params['t'])) {$this->_type = $params['t'];}
		if (isset($params['return_type'])) {$this->_returnType = $params['return_type'];}
		if (isset($params['f'])) {$this->_validate = $params['f'];}
		if (isset($params['search'])) {$this->_search = $params['search'];}
	}

	public function checkInput() {
		switch ($this->_type) {
			case 'user':
				$this->_validationResult = $this->_validationModel->validateUser($this->_validate, $this->_search);
				break;
		}
		echo json_encode($this->_validationResult);
	}
}
?>
