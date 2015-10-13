<?php
require_once _CONST_CLASS_PATH . 'class.database.php';
class UserModel extends Database {

	private $_modelQuery = '';
	private $_queryResult = '';
	private $join_query = '';
	private $select_params = '';

	public function __construct($cmsUserId = NULL, $cmsUserParams = array()) {
		parent::__construct();
	}

	protected function getMagazineSubscriberCount($type = NULL) {
		if ($type == 'partner') {
			$this->join_query = ' INNER JOIN magazine_partner mag_prtnr ON mag_prtnr.partner_code = ordr.promotional';
		}

		if (isset($_GET['partner_code']) && $_GET['partner_code'] != '') {
			$where_condition = ' mag_prtnr.partner_code like "%' . $_GET['partner_code'] . '%"';
		}
		if (isset($_GET['user_id']) && $_GET['user_id'] != '') {
			$where_condition = ' u.user_id like "%' . $_GET['user_id'] . '%"';
		}
		if ($where_condition != '') {
			$where_condition = ' where ' . $where_condition;
		}

		$this->_modelQuery = 'select count(1) as cnt from users u INNER JOIN order_details ordr ON u.uid = ordr.uid INNER JOIN subscription_packages pkg ON pkg.package_id = ordr.package_id ' . $this->join_query . $where_condition;
		$this->query($this->_modelQuery);
		return $this->single();
	}

	protected function getMagazineSubscriberList($order, $offset, $limit, $type = NULL) {
		if ($type == 'partner') {
			$this->join_query = ' INNER JOIN magazine_partner mag_prtnr ON mag_prtnr.partner_code = ordr.promotional';
			$this->select_params = 'mag_prtnr.partner_code, ';
		}
		if (isset($_GET['partner_code']) && $_GET['partner_code'] != '') {$where_condition = ' mag_prtnr.partner_code like "%' . $_GET['partner_code'] . '%"';}
		if (isset($_GET['user_id']) && $_GET['user_id'] != '') {$where_condition = ' u.user_id like "%' . $_GET['user_id'] . '%"';}
		if ($where_condition != '') {
			$where_condition = ' where ' . $where_condition;
		}
		$this->_modelQuery = 'select ' . $this->select_params . ' u.uid as customer_id,u.uid as id, u.user_id as user_id, u.name as name, emailid as email_id, mobileno as mobile, ordr.order_id as order_id, ordr.tracking_id, ordr.issue_startdt as starts_date, ordr.issue_enddt as end_date, pkg.no_of_months as subscription_pkg, pkg.subscription_type, ordr.subscription_amount, ordr.amount, ordr.payment_mode from users u INNER JOIN order_details ordr ON u.uid = ordr.uid INNER JOIN subscription_packages pkg ON pkg.package_id = ordr.package_id ' . $this->join_query . ' ' . $where_condition . ' order by ordr.order_id ' . $order . ' limit ' . $offset . ',' . $limit . '';
		$this->query($this->_modelQuery);

		return $this->resultset();
	}

	protected function getMagazineSubscriberDetails($order, $offset, $limit, $type = NULL) {
		$total = $this->getMagazineSubscriberCount($type);
		$userList = $this->getMagazineSubscriberList($order, $offset, $limit, $type);
		return json_encode(array("total" => (int) $total['cnt'], "rows" => $userList));
	}
}
?>
