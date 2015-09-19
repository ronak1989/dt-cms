<?php
require_once _CONST_MODEL_PATH . $controller_name . 'Model.php';
class Partner extends PartnerModel {
	private $access_roles = array();
	private $_partnerModel = NULL;
	private $limit = 10;
	private $offset = 10;
	private $order = "desc";
	private $_data = array();

	private $columnHeadings = array();

	static $pageTitle = 'Magazine Partners';
	static $pageSubTitle = '';

	public function __construct($id = NULL, $params = array()) {

		if (isset($_GET['limit'])) {$this->limit = $_GET['limit'];}
		if (isset($_GET['offset'])) {$this->offset = $_GET['offset'];}
		if (isset($_GET['order'])) {$this->order = $_GET['order'];}
		$this->_partnerModel = new PartnerModel(NULL, NULL);
	}

	public function getPartners() {
		$this->columnHeadings = array('partner_id' => 'SR NO', 'partner_code' => 'PARTNER CODE', 'partner_name' => 'PARTNER NAME', 'contact_person' => 'CONATACT PERSON', 'mobile_no' => 'PRIMARY MOBILE NO', 'secondary_mobileno' => 'SECONDARY MOBILE NO', 'email_id' => 'EMAIL ID', 'office_address' => 'OFFICE ADDRESS', 'residential_address' => 'RESIDENTIAL ADDRESS', 'enrollment_fee' => 'ENROLLMENT FEE', 'payment_option' => 'PAYMENT OPTION', 'bank_name' => 'BANK NAME', 'cheque_no' => 'CHEQUE NO', 'bank_branch' => 'BRANCH', 'ifsc_code' => 'IFSC CODE', 'micr_code' => 'MICR CODE', 'url' => 'URL');
		$data_url = '/get-magazine-partner/list';
		$this->_data['url']['add'] = _CONST_WEB_URL . '/partner/add';
		require_once _CONST_VIEW_PATH . 'userlist.tpl.php';
	}

	public function getMagazinePartnerDetails() {
		$data = $this->_partnerModel->getPartnerDetails($this->order, $this->offset, $this->limit);
		echo $data;
	}

	public function addPartner() {
		require_once _CONST_VIEW_PATH . 'partneradd.tpl.php';
	}

}
?>
