<?php
require_once _CONST_MODEL_PATH . $controller_name . 'Model.php';
class role extends roleModel {

	private $access_roles = array();
	private $_data = array();
	private $_roleModel = NULL;
	private $_columnList = array('ROLE ID', 'Category', 'ROLE NAME', 'STATUS', 'CREATED BY', 'CREATED DATE', 'MODIFIED DATE');
	static $_roleCategory = array('admin' => 'Admin', 'editor' => 'Editor', 'management' => 'Management', 'production' => 'Production', 'marketing' => 'Marketing', 'others' => 'Others');
	private $_formParams = array();
	private $_operationStatus = NULL;
	private $_crudID = NULL;
	static $pageTitle = 'Role Master';
	static $pageSubTitle = '';
	/*
	arrayStructure = labelTitle,inputType,FieldType,FieldName,FieldId,remoteValidate,displayType,displayFormat,
	selectOptions - multidimensional array
	radio - value,checked;
	 */
	public static $_formFields = array(
		'role_id' => array('skip' => array('insert')),
		'cateogry' => array('labelTitle' => 'Role Category', 'inputType' => 'select', 'fieldType' => 'select', 'remoteValidate' => false, 'selectOptions' => array('admin' => 'Admin', 'editor' => 'Editor', 'management' => 'Management', 'production' => 'Production', 'marketing' => 'Marketing', 'others' => 'Others'), 'required' => false, 'fieldValue' => ''),
		'role_name' => array('labelTitle' => 'Role Name', 'inputType' => 'text', 'fieldType' => 'text', 'remoteValidate' => true, 'required' => true, 'fieldValue' => ''),
		'status' => array('labelTitle' => 'Status', 'inputType' => 'radio', 'fieldType' => 'radio', 'remoteValidate' => false, 'radioButton' => array(array('val' => 'active', 'checked' => 'checked', 'label' => 'Active'), array('val' => 'inactive', 'checked' => '', 'label' => 'Inactive')), 'required' => false, 'fieldValue' => ''),
	);

	private function redirect($status, $redirectUrl) {
		http_response_code($status);
		header("Location: " . $redirectUrl);
	}

	public function __construct($id = NULL, $params = array()) {
		$this->access_roles[] = 'admin';
		$this->_data['url']['list'] = _CONST_WEB_URL . '/master/role/list';
		$this->_data['url']['add'] = _CONST_WEB_URL . '/master/role/create';
		$this->_data['url']['delete'] = _CONST_WEB_URL . '/master/role/delete';
		$this->_data['url']['view'] = _CONST_WEB_URL . '/master/role/view';
		$this->_data['url']['edit'] = _CONST_WEB_URL . '/master/role/edit';
		$this->_data['url']['save'] = _CONST_WEB_URL . '/master/role/save';
		$this->_data['url']['patch'] = _CONST_WEB_URL . '/master/role/patch';
		$this->_data['url']['formAction'] = '';
		$this->_data['url']['confirmationModal']['delete'] = array('title' => 'Disable Role ', 'message' => 'Are you sure you want to disable this Role');
		foreach ($params as $key => $value) {
			if (array_key_exists($key, self::$_formFields)) {
				self::$_formFields[$key]['fieldValue'] = $value;
			}
		}
		$this->_crudID = ($id == '' || $id == NULL) ? NULL : $id;
		$this->_roleModel = new roleModel($this->_crudID, self::$_formFields);
	}

	public function getColumnHeadings() {

		foreach ($this->_columnList as $key => $value) {
			$columnHeading .= '
			<th>' . $value . '</th>';
		}
		$columnHeading .= '<th class=" no-link last"><span class="nobr">Action</span></th>';
		return $columnHeading;
	}

	public function details() {
		self::$pageSubTitle = 'Role List';
		$this->_data['tblColumns'] = $this->getColumnHeadings();
		$this->_data['tblData'] = $this->_roleModel->getHtmlFormat($this->_data['url']);
		require_once _CONST_VIEW_PATH . 'list.tpl.php';
	}

	public function view() {
		echo 'Inside View Function';
	}

	public function create() {
		self::$pageSubTitle = 'Add New Role Into Role Master Table';
		$this->_data['url']['formAction'] = $this->_data['url']['save'];
		$this->_data['addForm'] = $this->_roleModel->getRoleForm();
		require_once _CONST_VIEW_PATH . 'form.tpl.php';
	}

	public function edit() {
		self::$pageTitle = 'Role Master - Edit';
		self::$pageSubTitle = 'Editing record ID - ' . $this->_crudID;
		parent::$_roleFields['role_id'] = array('inputType' => 'hidden', 'fieldType' => 'hidden', 'fieldValue' => $this->_crudID);
		$this->_roleModel->loadValues();
		$this->_data['url']['formAction'] = $this->_data['url']['patch'];
		$this->_data['addForm'] = $this->_roleModel->getRoleForm();
		require_once _CONST_VIEW_PATH . 'form.tpl.php';
	}

	public function patch() {
		if (stripos($_SERVER['HTTP_REFERER'], $this->_data['url']['edit']) !== false) {
			$this->_operationStatus = $this->_roleModel->updateRecord();
			if ($this->_operationStatus == true) {
				$this->redirect(303, $this->_data['url']['list']);
			} else {
				echo 'error';
			}
		}
	}

	public function save() {
		$this->_operationStatus = $this->_roleModel->saveDetails();
		if ($this->_operationStatus == true) {
			$this->redirect(303, $this->_data['url']['list']);
		} else {
			echo 'error';
		}
	}

	public function delete() {
		if ($_SERVER['HTTP_REFERER'] == $this->_data['url']['list']) {
			$this->_operationStatus = $this->_roleModel->inactivateRecord();
			if ($this->_operationStatus == true) {
				$this->redirect(303, $this->_data['url']['list']);
			} else {
				echo 'error';
			}
		}
	}

}

?>
