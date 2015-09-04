<?php
require_once _CONST_MODEL_PATH . $controller_name . 'Model.php';
class site extends siteModel {

	private $access_roles = array();
	private $_data = array();
	private $_siteModel = NULL;
	private $_columnList = array('SITE ID', 'SITE URL', 'STATUS', 'CREATED BY', 'CREATED DATE', 'MODIFIED DATE');
	private $_formParams = array();
	private $_operationStatus = NULL;
	private $_crudID = NULL;
	static $pageTitle = 'SiteMaster';
	static $pageSubTitle = '';
	/*
	arrayStructure = labelTitle,inputType,FieldType,FieldName,FieldId,remoteValidate,displayType,displayFormat,
	selectOptions - multidimensional array
	radio - value,checked;
	 */

	public static $_formFields = array(
		'site_id' => array('skip' => array('insert')),
		'site_name' => array('labelTitle' => 'Site URL', 'inputType' => 'text', 'fieldType' => 'url', 'remoteValidate' => true, 'required' => true, 'fieldValue' => ''),
		'registration_template_id' => array('labelTitle' => 'Registration Template', 'inputType' => 'select', 'fieldType' => 'select', 'remoteValidate' => false, 'selectOptions' => array(), 'required' => false, 'fieldValue' => ''),
		'thankyou_template_id' => array('labelTitle' => 'Thank You Template', 'inputType' => 'select', 'fieldType' => 'select', 'remoteValidate' => false, 'selectOptions' => array(), 'required' => false, 'fieldValue' => ''),
		'forgotpassword_template_id' => array('labelTitle' => 'Forgot Password Template', 'inputType' => 'select', 'fieldType' => 'select', 'remoteValidate' => false, 'selectOptions' => array(), 'required' => false, 'fieldValue' => ''),
		'verifyemail_template_id' => array('labelTitle' => 'Verify Email Template', 'inputType' => 'select', 'fieldType' => 'select', 'remoteValidate' => false, 'selectOptions' => array(), 'required' => false, 'fieldValue' => ''),
		'status' => array('labelTitle' => 'Status', 'inputType' => 'radio', 'fieldType' => 'radio', 'remoteValidate' => false, 'radioButton' => array(array('val' => 'active', 'checked' => 'checked', 'label' => 'Active'), array('val' => 'inactive', 'checked' => '', 'label' => 'Inactive')), 'required' => false, 'fieldValue' => ''),
	);

	private function redirect($status, $redirectUrl) {
		http_response_code($status);
		header("Location: " . $redirectUrl);
	}

	public function __construct($id = NULL, $params = array()) {
		$this->access_roles[] = 'admin';
		$this->_data['url']['list'] = _CONST_WEB_URL . '/master/site/list';
		$this->_data['url']['add'] = _CONST_WEB_URL . '/master/site/create';
		$this->_data['url']['delete'] = _CONST_WEB_URL . '/master/site/delete';
		$this->_data['url']['view'] = _CONST_WEB_URL . '/master/site/view';
		$this->_data['url']['edit'] = _CONST_WEB_URL . '/master/site/edit';
		$this->_data['url']['save'] = _CONST_WEB_URL . '/master/site/save';
		$this->_data['url']['patch'] = _CONST_WEB_URL . '/master/site/patch';
		$this->_data['url']['formAction'] = '';
		$this->_data['url']['confirmationModal']['delete'] = array('title' => 'Disable Site ', 'message' => 'Are you sure you want to disable this Site');
		foreach ($params as $key => $value) {
			if (array_key_exists($key, self::$_formFields)) {
				self::$_formFields[$key]['fieldValue'] = $value;
			}
		}
		$this->_crudID = ($id == '' || $id == NULL) ? NULL : $id;
		$this->_siteModel = new siteModel($this->_crudID, self::$_formFields);
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
		self::$pageSubTitle = 'Site List';
		$this->_data['tblColumns'] = $this->getColumnHeadings();
		$this->_data['tblData'] = $this->_siteModel->getHtmlFormat($this->_data['url']);
		require_once _CONST_VIEW_PATH . 'list.tpl.php';
	}

	public function view() {
		echo 'Inside View Function';
	}

	public function create() {
		self::$pageSubTitle = 'Add New Entry Into Site Master Table';
		$this->_data['url']['formAction'] = $this->_data['url']['save'];
		$this->_data['addForm'] = $this->_siteModel->getSiteForm();
		require_once _CONST_VIEW_PATH . 'form.tpl.php';
	}

	public function edit() {
		self::$pageTitle = 'Site Master - Edit';
		self::$pageSubTitle = 'Editing record ID - ' . $this->_crudID;
		parent::$_siteFields['site_id'] = array('inputType' => 'hidden', 'fieldType' => 'hidden', 'fieldValue' => $this->_crudID);
		$this->_siteModel->loadValues();
		$this->_data['url']['formAction'] = $this->_data['url']['patch'];
		$this->_data['addForm'] = $this->_siteModel->getSiteForm();
		require_once _CONST_VIEW_PATH . 'form.tpl.php';
	}

	public function patch() {
		if (stripos($_SERVER['HTTP_REFERER'], $this->_data['url']['edit']) !== false) {
			$this->_operationStatus = $this->_siteModel->updateRecord();
			if ($this->_operationStatus == true) {
				$this->redirect(303, $this->_data['url']['list']);
			} else {
				echo 'error';
			}
		}
	}

	public function save() {
		$this->_operationStatus = $this->_siteModel->saveDetails();
		if ($this->_operationStatus == true) {
			$this->redirect(303, $this->_data['url']['list']);
		} else {
			echo 'error';
		}
	}

	public function delete() {
		if ($_SERVER['HTTP_REFERER'] == $this->_data['url']['list']) {
			$this->_operationStatus = $this->_siteModel->inactivateRecord();
			if ($this->_operationStatus == true) {
				$this->redirect(303, $this->_data['url']['list']);
			} else {
				echo 'error';
			}
		}
	}

}

?>
