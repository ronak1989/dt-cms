<?php
require_once _CONST_CLASS_PATH . 'class.database.php';
require_once _CONST_CLASS_PATH . 'class.formrender.php';
class SiteModel extends Database {
	private $_modelQuery = '';
	private $_queryResult = '';
	private $_returnData = NULL;
	private $_formRender = NULL;
	private $_siteId = NULL;
	protected static $_siteFields = NULL;
	public function __construct($siteId = NULL, $siteParams = array()) {
		parent::__construct();
		$this->_siteId = $siteId;
		self::$_siteFields = $siteParams;
	}

	private function getDetails() {
		$this->_modelQuery = 'SELECT site_master.site_id, site_master.site_name, site_master.status, cms_users.employee_name, site_master.created_date, site_master.modified_date FROM site_master as site_master INNER JOIN cms_users as cms_users WHERE site_master.created_by = cms_users.cms_id';
		$this->query($this->_modelQuery);
		return $this->resultset();
	}

	private function getDetailsById() {
		$this->_modelQuery = 'SELECT site_id, site_name, status FROM site_master where site_id = :site_id';
		$this->query($this->_modelQuery);
		$this->bindByValue('site_id', $this->_siteId);
		return $this->resultset();
	}

	protected function getHtmlFormat($genericUrls) {
		/**
		 * | <a href="' . $genericUrls['view'] . '/' . $value['site_id'] . '">View</a>
		 */
		$this->_queryResult = $this->getDetails();
		foreach ($this->_queryResult as $key => $value) {
			$class = ($key % 2 == 0) ? 'even' : 'odd';
			$this->_returnData .= '<tr class=" ' . $class . ' pointer">
												<td class=" ">' . $value['site_id'] . '</td>
												<td class=" ">' . $value['site_name'] . '</td>
												<td class=" ">' . $value['status'] . '</td>
												<td class=" ">' . $value['name'] . '</td>
												<td class="a-right a-right ">' . $value['created_date'] . '</td>
												<td class="a-right a-right ">' . $value['modified_date'] . '</td>
												<td class=" last">
													<a class="btn btn-info btn-xs" href="' . $genericUrls['edit'] . '/' . $value['site_id'] . '"><i class="fa fa-pencil"></i> Edit </a>
													<form method="POST" action="' . $genericUrls['delete'] . '/' . $value['site_id'] . '" accept-charset="UTF-8" style="display:inline">
														<button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#confirmDelete" data-title="' . $genericUrls['confirmationModal']['delete']['title'] . ' - <b>' . $value['site_name'] . '</b>" data-message="' . $genericUrls['confirmationModal']['delete']['message'] . '">
															<i class="glyphicon glyphicon-trash"></i> Disable
														</button>
													</form>
												</td>
											</tr>';
		}
		return $this->_returnData;
	}

	protected function loadValues() {
		$this->_fieldList = self::$_siteFields;
		$this->_queryResult = $this->getDetailsById();
		foreach ($this->_queryResult[0] as $key => $value) {
			self::$_siteFields[$key]['fieldValue'] = $value;
		}
	}

	protected function getSiteForm() {
		$this->_formRender = new FromRender(self::$_siteFields);
		return $this->_formRender->getForm();
	}

	protected function saveDetails() {
		$this->_modelQuery = 'INSERT INTO site_master (`site_name`,`registration_template_id`,`thankyou_template_id`,`forgotpassword_template_id`,`verifyemail_template_id`,`status`,`created_by`) VALUES (:site_name,:registration_template_id,:thankyou_template_id,:forgotpassword_template_id,:verifyemail_template_id,:status,:created_by)';
		$this->query($this->_modelQuery);
		foreach (self::$_siteFields as $key => $value) {
			if (!empty($value['skip'])) {
				if (in_array('insert', $value['skip']) === true) {
					continue;
				}
			}

			if ($value['fieldValue'] == '' || $value['fieldValue'] == NULL) {
				$value['fieldValue'] = NULL;
			}
			$this->bindByValue($key, $value['fieldValue']);
		}
		$this->bindByValue('created_by', 1);

		if ($this->execute()) {
			return true;
		} else {
			return false;
		}
	}

	protected function inactivateRecord() {
		$this->_modelQuery = 'UPDATE site_master set status="inactive" where site_id=:site_id';
		$this->query($this->_modelQuery);
		$this->bindByValue('site_id', $this->_siteId, PDO::PARAM_INT);
		if ($this->execute()) {
			return true;
		} else {
			return false;
		}
	}

	protected function updateRecord() {
		$this->_modelQuery = 'UPDATE site_master set `site_name` = :site_name,`registration_template_id` = :registration_template_id,`thankyou_template_id`= :thankyou_template_id,`forgotpassword_template_id` = :forgotpassword_template_id,`verifyemail_template_id`= :verifyemail_template_id,`created_by`= :created_by, `status`=:status where site_id=:site_id';
		$this->query($this->_modelQuery);

		foreach (self::$_siteFields as $key => $value) {
			if ($value['fieldValue'] == '' || $value['fieldValue'] == NULL) {
				$value['fieldValue'] = NULL;
			}
			$this->bindByValue($key, $value['fieldValue']);
		}
		$this->bindByValue('created_by', 1);
		if ($this->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
?>
