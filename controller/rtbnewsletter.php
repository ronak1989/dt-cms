<?php
require_once _CONST_MODEL_PATH . $controller_name . 'Model.php';
class rtbNewsletter extends rtbNewsletterModel {

	private $access_roles = array();
	private $_data = array();
	private $_rtbNewsletterModel = NULL;
	private $_columnList = array('RTB ID', 'RECOMMENDATION DATE', 'HEADING', 'CREATED BY', 'CREATED DATE', 'MODIFIED DATE');
	private $_formParams = array();
	private $_operationStatus = NULL;
	private $_crudID = NULL;
	static $pageTitle = 'RTB Newsletter';
	static $pageSubTitle = '';
	/*
	arrayStructure = labelTitle,inputType,FieldType,FieldName,FieldId,remoteValidate,displayType,displayFormat,
	selectOptions - multidimensional array
	radio - value,checked;
	 */
	public static $_formFields = array(
		'id' => array('skip' => array('insert')),
		'nifty_chart' => array('inputType' => 'hidden', 'fieldType' => 'hidden', 'fieldValue' => ''),
		'buzzer_filepath' => array('inputType' => 'hidden', 'fieldType' => 'hidden', 'fieldValue' => '', 'skip' => array('insert', 'update', 'delete', 'edit')),
		'recommendation_date' => array('labelTitle' => 'Recommendation Date', 'inputType' => 'date', 'fieldType' => 'text', 'remoteValidate' => false, 'required' => true, 'fieldValue' => ''),
		'rtb_header' => array('labelTitle' => 'Header Image', 'inputType' => 'radio', 'fieldType' => 'radio', 'remoteValidate' => false, 'radioButton' => array(array('val' => 'bull', 'checked' => '', 'label' => 'Bull'), array('val' => 'bear', 'checked' => '', 'label' => 'Bear')), 'required' => true, 'fieldValue' => ''),
		'chart_img' => array('labelTitle' => 'Nifty Chart', 'inputType' => 'file', 'fieldType' => 'file', 'remoteValidate' => false, 'required' => true, 'fieldValue' => '', 'skip' => array('insert', 'update', 'delete', 'edit')),
		'bottom_line' => array('labelTitle' => 'Bottom Line', 'inputType' => 'editor', 'fieldType' => 'textarea', 'remoteValidate' => false, 'required' => false, 'fieldValue' => ''),
		'intraday_trader' => array('labelTitle' => 'Intraday Trader', 'inputType' => 'editor', 'fieldType' => 'textarea', 'remoteValidate' => false, 'required' => false, 'fieldValue' => ''),
		'positional_trader' => array('labelTitle' => 'Positional Trader', 'inputType' => 'editor', 'fieldType' => 'textarea', 'remoteValidate' => false, 'required' => false, 'fieldValue' => ''),
		'tow_bull' => array('labelTitle' => 'Tug of War - Bull', 'inputType' => 'text', 'fieldType' => 'number', 'remoteValidate' => false, 'required' => true, 'fieldValue' => ''),
		'tow_bear' => array('labelTitle' => 'Tug of War - Bear', 'inputType' => 'text', 'fieldType' => 'number', 'remoteValidate' => false, 'required' => true, 'fieldValue' => ''),
		'keep_an_eye_trend' => array('labelTitle' => 'Keep an Eye (Trend)', 'inputType' => 'radio', 'fieldType' => 'radio', 'remoteValidate' => false, 'radioButton' => array(array('val' => 'bull', 'checked' => '', 'label' => 'Bull'), array('val' => 'bear', 'checked' => '', 'label' => 'Bear')), 'required' => true, 'fieldValue' => ''),
		'keep_an_eye_breakpoint' => array('labelTitle' => 'Keep an Eye breakpoint', 'inputType' => 'text', 'fieldType' => 'number', 'remoteValidate' => false, 'required' => true, 'fieldValue' => ''),
		'csv_upload' => array('labelTitle' => 'Upload CSV file for Action Buzzers & Nifty Trend', 'inputType' => 'file', 'fieldType' => 'file', 'remoteValidate' => false, 'required' => true, 'fieldValue' => '', 'skip' => array('insert', 'update', 'delete', 'edit')),
		'status' => array('labelTitle' => 'Status', 'inputType' => 'radio', 'fieldType' => 'radio', 'remoteValidate' => false, 'radioButton' => array(array('val' => 'active', 'checked' => 'checked', 'label' => 'Active'), array('val' => 'inactive', 'checked' => '', 'label' => 'Inactive')), 'required' => false, 'fieldValue' => ''),
	);

	private function redirect($status, $redirectUrl) {
		http_response_code($status);
		header("Location: " . $redirectUrl);
	}

	public function __construct($id = NULL, $params = array()) {
		$this->access_roles[] = 'admin';
		$this->_data['url']['list'] = _CONST_WEB_URL . '/master/rtbnewsletter/list';
		$this->_data['url']['add'] = _CONST_WEB_URL . '/master/rtbnewsletter/create';
		$this->_data['url']['delete'] = _CONST_WEB_URL . '/master/rtbnewsletter/delete';
		$this->_data['url']['view'] = _CONST_WEB_URL . '/master/rtbnewsletter/view';
		$this->_data['url']['edit'] = _CONST_WEB_URL . '/master/rtbnewsletter/edit';
		$this->_data['url']['save'] = _CONST_WEB_URL . '/master/rtbnewsletter/save';
		$this->_data['url']['patch'] = _CONST_WEB_URL . '/master/rtbnewsletter/patch';
		$this->_data['url']['formAction'] = '';
		$this->_data['url']['confirmationModal']['delete'] = array('title' => 'Disable User ', 'message' => 'Are you sure you want to disable this User');
		foreach ($params as $key => $value) {
			if (array_key_exists($key, self::$_formFields)) {
				self::$_formFields[$key]['fieldValue'] = $value;
			}
		}
		$this->_crudID = ($id == '' || $id == NULL) ? NULL : $id;
		$this->_rtbNewsletterModel = new rtbNewsletterModel($this->_crudID, self::$_formFields);
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
		$this->_data['tblData'] = $this->_rtbNewsletterModel->getHtmlFormat($this->_data['url']);
		require_once _CONST_VIEW_PATH . 'list.tpl.php';
	}

	public function view() {
		echo 'Inside View Function';
	}

	public function create() {
		self::$pageSubTitle = 'Create `Ring The Bell` Newsletter';
		$this->_data['url']['formAction'] = $this->_data['url']['save'];
		$this->_data['addForm'] = $this->_rtbNewsletterModel->getRtbNewsletterForm();
		require_once _CONST_VIEW_PATH . 'form.tpl.php';
	}

	public function edit() {
		self::$pageTitle = 'CMS User - Update';
		self::$pageSubTitle = 'Editing record ID - ' . $this->_crudID;
		parent::$_rtbNewsletterFields['cms_id'] = array('inputType' => 'hidden', 'fieldType' => 'hidden', 'fieldValue' => $this->_crudID);
		unset(parent::$_rtbNewsletterFields['password']);
		unset(parent::$_rtbNewsletterFields['confirmpassword']);
		$this->_rtbNewsletterModel->loadValues();
		$this->_data['url']['formAction'] = $this->_data['url']['patch'];
		$this->_data['addForm'] = $this->_rtbNewsletterModel->getRtbNewsletterForm();
		require_once _CONST_VIEW_PATH . 'form.tpl.php';
	}

	public function patch() {

		/*if (stripos($_SERVER['HTTP_REFERER'], $this->_data['url']['edit']) !== false) {
	$this->_operationStatus = $this->_rtbNewsletterModel->updateRecord();
	if ($this->_operationStatus == true) {
	$this->redirect(303, $this->_data['url']['list']);
	} else {
	echo 'error';
	}
	}*/
	}

	public function save() {
		parent::$_rtbNewsletterFields['recommendation_date'] = strtotime(parent::$_rtbNewsletterFields['recommendation_date']['fieldValue']);
		$this->_operationStatus = $this->_rtbNewsletterModel->saveDetails();
		if ($this->_operationStatus == true) {
			$this->redirect(303, $this->_data['url']['list']);
		} else {
			echo 'error';
		}
	}

	public function delete() {
		if ($_SERVER['HTTP_REFERER'] == $this->_data['url']['list']) {
			$this->_operationStatus = $this->_rtbNewsletterModel->inactivateRecord();
			if ($this->_operationStatus == true) {
				$this->redirect(303, $this->_data['url']['list']);
			} else {
				echo 'error';
			}
		}
	}

}

?>
