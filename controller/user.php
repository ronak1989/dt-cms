<?php
require_once _CONST_MODEL_PATH . $controller_name . 'Model.php';
class User extends UserModel {
	private $access_roles = array();
	private $_userModel = NULL;
	private $limit = 10;
	private $offset = 10;
	private $order = "desc";

	private $columnHeadings = array('customer_id' => 'CUSTOMER ID', 'name' => 'NAME', 'email_id' => 'EMAIL-ID', 'mobile' => 'CONTACT NO', 'order_id' => 'ORDER ID', 'tracking_id' => 'Tracking ID', 'start_date' => 'STARTS ON', 'end_date' => 'EXPIRY ON', 'subscription_pkg' => 'SUBSCRIPTION PACKAGE', 'subscription_type' => 'SUBSCRIPTION TYPE', 'subscription_amount' => 'SUBSCRIPTION AMOUNT', 'amount' => 'AMOUNT PAID BY USER', 'payment_mode' => 'MODE OF PAYMENT');

	static $pageTitle = 'Magazine Users';
	static $pageSubTitle = '';

	public function __construct($id = NULL, $params = array()) {

		if (isset($_GET['limit'])) {$this->limit = $_GET['limit'];}
		if (isset($_GET['offset'])) {$this->offset = $_GET['offset'];}
		if (isset($_GET['order'])) {$this->order = $_GET['order'];}
		$this->_userModel = new userModel(NULL, NULL);
	}

	private function insertBeforeKey($array, $key, $data = null) {
		if (($offset = array_search($key, array_keys($array))) === false) // if the key doesn't exist
		{
			$offset = 0; // should we prepend $array with $data?
			$offset = count($array); // or should we append $array with $data? lets pick this one...
		}

		return array_merge(array_slice($array, 0, $offset), (array) $data, array_slice($array, $offset));
	}

	public function getMagazineUsers() {
		$data_url = '/get-magazine-subscriber/list';
		require_once _CONST_VIEW_PATH . 'userlist.tpl.php';
	}

	public function getMagazineUsersDetails() {
		$data = $this->_userModel->getMagazineSubscriberDetails($this->order, $this->offset, $this->limit);
		echo $data;
	}

	public function getMagazinePartnerUsers() {
		$this->columnHeadings = $this->insertBeforeKey($this->columnHeadings, 'customer_id', array('partner_code' => 'PARTNER CODE'));
		$data_url = '/get-magazine-partner-subscriber/list';
		require_once _CONST_VIEW_PATH . 'userlist.tpl.php';
	}

	public function getMagazinePartnerUsersDetails() {
		$data = $this->_userModel->getMagazineSubscriberDetails($this->order, $this->offset, $this->limit, 'partner');
		echo $data;
	}
}
?>
