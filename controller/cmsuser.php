<?php
require_once _CONST_MODEL_PATH . $controller_name . 'Model.php';
class cmsUser extends cmsUserModel {

	private $access_roles = array();
	private $_data = array();
	private $_cmsUserModel = NULL;
	private $_columnList = array('EMP ID', 'NAME', 'EMAIL-ID', 'STATUS', 'CREATED BY', 'CREATED DATE', 'MODIFIED DATE');
	private $_formParams = array();
	private $_operationStatus = NULL;
	private $_crudID = NULL;
	static $pageTitle = 'CMS User';
	static $pageSubTitle = '';
	/*
	arrayStructure = labelTitle,inputType,FieldType,FieldName,FieldId,remoteValidate,displayType,displayFormat,
	selectOptions - multidimensional array
	radio - value,checked;
	 */
	public static $_formFields = array(
		'cms_id' => array('skip' => array('insert')),
		'employee_id' => array('labelTitle' => 'Employee Id', 'inputType' => 'text', 'fieldType' => 'text', 'remoteValidate' => true, 'required' => true, 'fieldValue' => ''),
		'employee_name' => array('labelTitle' => 'Employee Name', 'inputType' => 'text', 'fieldType' => 'text', 'remoteValidate' => false, 'required' => true, 'fieldValue' => ''),
		'mail' => array('labelTitle' => 'Email Id', 'inputType' => 'text', 'fieldType' => 'email', 'remoteValidate' => true, 'required' => true, 'fieldValue' => ''),
		'password' => array('labelTitle' => 'Password', 'inputType' => 'text', 'fieldType' => 'password', 'remoteValidate' => false, 'required' => true, 'fieldValue' => '', 'skip' => array('update')),
		'confirmpassword' => array('labelTitle' => 'Confirm Password', 'inputType' => 'text', 'fieldType' => 'password', 'remoteValidate' => false, 'required' => true, 'fieldValue' => '', 'skip' => array('update', 'insert')),
		'profile' => array('labelTitle' => 'Employee Profile', 'inputType' => 'textarea', 'fieldType' => 'textarea', 'remoteValidate' => false, 'required' => false, 'fieldValue' => ''),
		'contact_no' => array('labelTitle' => 'Mobile No', 'inputType' => 'text', 'fieldType' => 'number', 'remoteValidate' => false, 'required' => true, 'fieldValue' => ''),
		'extn_no' => array('labelTitle' => 'Extension No', 'inputType' => 'text', 'fieldType' => 'number', 'remoteValidate' => false, 'required' => true, 'fieldValue' => ''),
		'designation' => array('labelTitle' => 'Designation', 'inputType' => 'text', 'fieldType' => 'text', 'remoteValidate' => false, 'required' => true, 'fieldValue' => ''),
		'site_id' => array('labelTitle' => 'CMS Access', 'inputType' => 'multiselect', 'fieldType' => 'select', 'remoteValidate' => false, 'selectOptions' => array(), 'required' => true, 'fieldValue' => array()),
		'role_id' => array('labelTitle' => 'User Roles', 'inputType' => 'multiselect', 'fieldType' => 'select', 'remoteValidate' => false, 'selectOptions' => array(), 'required' => true, 'fieldValue' => array()),
		'status' => array('labelTitle' => 'Status', 'inputType' => 'radio', 'fieldType' => 'radio', 'remoteValidate' => false, 'radioButton' => array(array('val' => 'active', 'checked' => 'checked', 'label' => 'Active'), array('val' => 'inactive', 'checked' => '', 'label' => 'Inactive')), 'required' => false, 'fieldValue' => ''),
	);

	private function redirect($status, $redirectUrl) {
		http_response_code($status);
		header("Location: " . $redirectUrl);
	}

	public function __construct($id = NULL, $params = array()) {
		$this->access_roles[] = 'admin';
		$this->_data['url']['list'] = _CONST_WEB_URL . '/master/cmsuser/list';
		$this->_data['url']['add'] = _CONST_WEB_URL . '/master/cmsuser/create';
		$this->_data['url']['delete'] = _CONST_WEB_URL . '/master/cmsuser/delete';
		$this->_data['url']['view'] = _CONST_WEB_URL . '/master/cmsuser/view';
		$this->_data['url']['edit'] = _CONST_WEB_URL . '/master/cmsuser/edit';
		$this->_data['url']['save'] = _CONST_WEB_URL . '/master/cmsuser/save';
		$this->_data['url']['patch'] = _CONST_WEB_URL . '/master/cmsuser/patch';
		$this->_data['url']['formAction'] = '';
		$this->_data['url']['confirmationModal']['delete'] = array('title' => 'Disable User ', 'message' => 'Are you sure you want to disable this User');
		foreach ($params as $key => $value) {
			if (array_key_exists($key, self::$_formFields)) {
				self::$_formFields[$key]['fieldValue'] = $value;
			}
		}
		$this->_crudID = ($id == '' || $id == NULL) ? NULL : $id;
		$this->_cmsUserModel = new cmsUserModel($this->_crudID, self::$_formFields);
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
		self::$pageSubTitle = 'CMS User List';
		$this->_data['tblColumns'] = $this->getColumnHeadings();
		$this->_data['tblData'] = $this->_cmsUserModel->getHtmlFormat($this->_data['url']);
		require_once _CONST_VIEW_PATH . 'list.tpl.php';
	}

	public function view() {
		echo 'Inside View Function';
	}

	public function create() {
		self::$pageSubTitle = 'Add New User Into the CMS';
		$this->_data['url']['formAction'] = $this->_data['url']['save'];
		$this->_data['addForm'] = $this->_cmsUserModel->getCmsUserForm();
		require_once _CONST_VIEW_PATH . 'form.tpl.php';
	}

	public function edit() {
		self::$pageTitle = 'CMS User - Update';
		self::$pageSubTitle = 'Editing record ID - ' . $this->_crudID;
		parent::$_cmsUserFields['cms_id'] = array('inputType' => 'hidden', 'fieldType' => 'hidden', 'fieldValue' => $this->_crudID);
		unset(parent::$_cmsUserFields['password']);
		unset(parent::$_cmsUserFields['confirmpassword']);
		$this->_cmsUserModel->loadValues();
		$this->_data['url']['formAction'] = $this->_data['url']['patch'];
		$this->_data['addForm'] = $this->_cmsUserModel->getCmsUserForm();
		require_once _CONST_VIEW_PATH . 'form.tpl.php';
	}

	public function patch() {
		if (stripos($_SERVER['HTTP_REFERER'], $this->_data['url']['edit']) !== false) {
			$this->_operationStatus = $this->_cmsUserModel->updateRecord();
			if ($this->_operationStatus == true) {
				$this->redirect(303, $this->_data['url']['list']);
			} else {
				echo 'error';
			}
		}
	}

	public function save() {
		$this->_operationStatus = $this->_cmsUserModel->saveDetails();
		if ($this->_operationStatus == true) {
			$this->redirect(303, $this->_data['url']['list']);
		} else {
			echo 'error';
		}
	}

	public function delete() {
		if ($_SERVER['HTTP_REFERER'] == $this->_data['url']['list']) {
			$this->_operationStatus = $this->_cmsUserModel->inactivateRecord();
			if ($this->_operationStatus == true) {
				$this->redirect(303, $this->_data['url']['list']);
			} else {
				echo 'error';
			}
		}
	}

}

?>
