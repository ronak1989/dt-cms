<?php
require_once _CONST_CLASS_PATH . 'class.database.php';
class PartnerModel extends Database {

	private $_modelQuery = '';
	private $_queryResult = '';

	public function __construct($cmsUserId = NULL, $cmsUserParams = array()) {
		parent::__construct();
	}

	protected function getPartnerCount() {
		$this->_modelQuery = 'select count(1) as cnt from magazine_partner ';
		$this->query($this->_modelQuery);
		return $this->single();
	}

	protected function getPartnerList($order, $offset, $limit) {
		$where_condition = '';
		if (isset($_GET['partner_code'])) {$where_condition = ' where partner_code like "%' . $_GET['partner_code'] . '%"';}
		$this->_modelQuery = 'select partner_id,partner_name,contact_person,mobile_no,secondary_mobileno,email_id,office_address,residential_address,enrollment_fee,payment_option,bank_name,cheque_no,bank_branch,ifsc_code,micr_code,concat("http://magazine.dalaltimes.com?_brtr=",url) as url,partner_code from magazine_partner ' . $where_condition . ' order by partner_id ' . $order . ' limit ' . $offset . ',' . $limit . '';
		$this->query($this->_modelQuery);
		return $this->resultset();
	}

	protected function getPartnerDetails($order, $offset, $limit) {
		$total = $this->getPartnerCount();
		$userList = $this->getPartnerList($order, $offset, $limit);
		return json_encode(array("total" => (int) $total['cnt'], "rows" => $userList));
	}
}
?>
