<?php
require_once _CONST_CLASS_PATH . 'class.database.php';
require_once _CONST_CLASS_PATH . 'class.formrender.php';
require_once _CONST_CLASS_PATH . 'Excel/reader.php';
class rtbNewsletterModel extends Database {
	private $_modelQuery = '';
	private $_queryResult = '';
	private $_returnData = NULL;
	private $_formRender = NULL;
	private $_rtbNewsletterId = NULL;
	protected static $_rtbNewsletterFields = NULL;

	public function __construct($rtbNewsletterId = NULL, $rtbNewsletterParams = array()) {
		parent::__construct();
		$this->_rtbNewsletterId = $rtbNewsletterId;
		self::$_rtbNewsletterFields = $rtbNewsletterParams;
	}

	private function deleteCmsUserRoles() {
		$this->_modelQuery = 'DELETE FROM user_roles WHERE cms_id=:cms_id';
		$this->query($this->_modelQuery);
		$this->bindByValue('cms_id', $this->_rtbNewsletterId);
		return $this->execute();
	}

	private function deleteCmsUserCmsAccess() {
		$this->_modelQuery = 'DELETE FROM cms_access WHERE cms_id=:cms_id';
		$this->query($this->_modelQuery);
		$this->bindByValue('cms_id', $this->_rtbNewsletterId);
		return $this->execute();
	}

	private function insertCmsUserRoles() {
		$_counter = 0;
		$_tmpCnt = count(self::$_rtbNewsletterFields['role_id']['fieldValue']);
		$this->_modelQuery = 'INSERT INTO user_roles (`cms_id`,`role_id`,`created_by`) VALUES (:cms_id,:role_id,:created_by)';
		$this->query($this->_modelQuery);
		$this->bindByParam(':cms_id', $this->_rtbNewsletterId);
		$this->bindByParam(':created_by', 1);
		do {
			$this->bindByParam(':role_id', self::$_rtbNewsletterFields['role_id']['fieldValue'][$_counter]);
			if ($this->execute() === false) {
				return false;
			}
			$_tmpCnt--;
			$_counter++;
		} while ($_tmpCnt > 0);
		return true;
	}

	private function insertCmsUserCmsAccess() {
		$_counter = 0;
		$_tmpCnt = count(self::$_rtbNewsletterFields['site_id']['fieldValue']);
		$this->_modelQuery = 'INSERT INTO cms_access (`site_id`,`cms_id`,`created_by`) VALUES (:site_id,:cms_id,:created_by)';
		$this->query($this->_modelQuery);
		$this->bindByParam(':cms_id', $this->_rtbNewsletterId);
		$this->bindByParam(':created_by', 1);
		do {
			$this->bindByParam(':site_id', self::$_rtbNewsletterFields['site_id']['fieldValue'][$_counter]);
			if ($this->execute() === false) {
				return false;
			}
			$_tmpCnt--;
			$_counter++;
		} while ($_tmpCnt > 0);
		return true;
	}

	private function getDetails() {
		$this->_modelQuery = 'SELECT cms_users.cms_id, cms_users.employee_id, cms_users.employee_name, cms_users.mail, cms_users.status, createdby.employee_name as created_by, cms_users.created_date, cms_users.modified_date FROM cms_users as cms_users JOIN cms_users as createdby ON cms_users.created_by = createdby.cms_id';
		$this->query($this->_modelQuery);
		return $this->resultset();
	}

	private function getDetailsById() {
		$this->_modelQuery = 'SELECT cms_users.cms_id, cms_users.employee_id,cms_users.employee_name, cms_users.mail,cms_users.profile,cms_users.contact_no,cms_users.extn_no,cms_users.designation,cms_users.status,GROUP_CONCAT(DISTINCT cms_access.site_id) as site_id,GROUP_CONCAT(DISTINCT user_roles.role_id) as role_id FROM cms_users LEFT JOIN cms_access ON cms_users.cms_id = cms_access.cms_id LEFT JOIN user_roles ON cms_users.cms_id = user_roles.cms_id WHERE cms_users.cms_id = :cms_id GROUP BY cms_users.cms_id';
		$this->query($this->_modelQuery);
		$this->bindByValue('cms_id', $this->_rtbNewsletterId);
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
												<td class=" ">' . $value['employee_id'] . '</td>
												<td class=" ">' . $value['employee_name'] . '</td>
												<td class=" ">' . $value['mail'] . '</td>
												<td class=" ">' . $value['status'] . '</td>
												<td class="a-right a-right ">' . $value['created_by'] . '</td>
												<td class="a-right a-right ">' . $value['created_date'] . '</td>
												<td class="a-right a-right ">' . $value['modified_date'] . '</td>
												<td class=" last">
													<a class="btn btn-info btn-xs" href="' . $genericUrls['edit'] . '/' . $value['cms_id'] . '"><i class="fa fa-pencil"></i> Edit </a>
													<form method="POST" action="' . $genericUrls['delete'] . '/' . $value['cms_id'] . '" accept-charset="UTF-8" style="display:inline">
														<button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#confirmDelete" data-title="' . $genericUrls['confirmationModal']['delete']['title'] . ' - <b>' . $value['employee_id'] . '</b>" data-message="' . $genericUrls['confirmationModal']['delete']['message'] . '">
															<i class="glyphicon glyphicon-trash"></i> Disable
														</button>
													</form>
												</td>
											</tr>';
		}
		return $this->_returnData;
	}

	protected function loadValues() {
		$this->_fieldList = self::$_rtbNewsletterFields;
		$this->_queryResult = $this->getDetailsById();
		foreach ($this->_queryResult[0] as $key => $value) {
			if ($key == 'site_id' || $key == 'role_id') {
				$_tmpvar = NULL;
				$_tmpvar = explode(',', $this->_queryResult[0][$key]);
				self::$_rtbNewsletterFields[$key]['fieldValue'] = $_tmpvar;
			} else {
				self::$_rtbNewsletterFields[$key]['fieldValue'] = $value;
			}
		}
	}

	protected function getRtbNewsletterForm() {
		#self::$_rtbNewsletterFields['site_id']['selectOptions'] = $this->getSiteList('create');
		#self::$_rtbNewsletterFields['role_id']['selectOptions'] = $this->getUserRoles('create');
		$this->_formRender = new FromRender(self::$_rtbNewsletterFields);
		return $this->_formRender->getForm();
	}

	protected function saveDetails() {
		$cmsSiteAccess = array();
		$cmsRoleAccess = array();
		$this->beginTransaction();
		$this->_modelQuery = 'INSERT INTO `rtb_master`(`recommendation_date`,`rtb_header`,`nifty_chart`,`bottom_line`,`intraday_trader`,`positional_trader`,`tow_bull`,`tow_bear`,`keep_an_eye_trend`,`keep_an_eye_breakpoint`,`created_by`,`status`) VALUES (:recommendation_date ,:rtb_header, :nifty_chart, :bottom_line, :intraday_trader, :positional_trader, :tow_bull, :tow_bear,:keep_an_eye_trend,:keep_an_eye_breakpoint,:created_by,:status);';
		$this->query($this->_modelQuery);
		foreach (self::$_rtbNewsletterFields as $key => $value) {
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
			$this->_rtbNewsletterId = $this->lastInsertId();

			// ExcelFile($filename, $encoding);
			$Spreadsheetdata = new Spreadsheet_Excel_Reader();

			// Set output Encoding.
			$Spreadsheetdata->setOutputEncoding('CP1251');
			$Spreadsheetdata->read(_CONST_WEB_ROOT_PATH . "uploads/" . self::$_rtbNewsletterFields['buzzer_filepath']['fieldValue']);
			for ($sheet = 0; $sheet < count($Spreadsheetdata->sheets); $sheet++) {
				$SpreadsheetName = $Spreadsheetdata->boundsheets[$sheet]['name'];
				if (str_replace(' ', '', strtolower($SpreadsheetName)) == 'actionbuzzers') {
					$this->_modelQuery = 'INSERT INTO `action_buzzers`(`rtb_master_id`,`buzz_type`,`buzzer_name`,`buzzer_url`,`action`,`entry_level_1`,`entry_level_2`,`target_1`,`target_2`,`stop_loss`) VALUES (:rtb_master_id,:buzz_type,:buzzer_name,:buzzer_url,:action,:entry_level_1,:entry_level_2,:target_1,:target_2,:stop_loss);';

					$this->query($this->_modelQuery);
					$this->bindByParam(':rtb_master_id', $this->_rtbNewsletterId);
				} else {
					$this->_modelQuery = 'INSERT INTO `nifty_trend`(`id`,`short_term`,`intermediate`,`long_term`,`high`,`low`) VALUES (:rtb_master_id,:short_term,:intermediate,:long_term,:high,:low)';

					$this->query($this->_modelQuery);
					$this->bindByParam(':rtb_master_id', $this->_rtbNewsletterId);

				}
				for ($i = 2; $i <= $Spreadsheetdata->sheets[$sheet]['numRows']; $i++) {
					if (str_replace(' ', '', strtolower($SpreadsheetName)) == 'actionbuzzers') {
						$this->bindByParam(':buzz_type', $Spreadsheetdata->sheets[$sheet]['cells'][$i][1]);
						$this->bindByParam(':buzzer_name', $Spreadsheetdata->sheets[$sheet]['cells'][$i][2]);
						$this->bindByParam(':buzzer_url', $Spreadsheetdata->sheets[$sheet]['cells'][$i][3]);
						$this->bindByParam(':action', $Spreadsheetdata->sheets[$sheet]['cells'][$i][4]);
						$this->bindByParam(':entry_level_1', $Spreadsheetdata->sheets[$sheet]['cells'][$i][5]);
						$this->bindByParam(':entry_level_2', $Spreadsheetdata->sheets[$sheet]['cells'][$i][6]);
						$this->bindByParam(':target_1', $Spreadsheetdata->sheets[$sheet]['cells'][$i][7]);
						$this->bindByParam(':target_2', $Spreadsheetdata->sheets[$sheet]['cells'][$i][8]);
						$this->bindByParam(':stop_loss', $Spreadsheetdata->sheets[$sheet]['cells'][$i][9]);
						if ($this->execute() === false) {
							$this->cancelTransaction();
							return false;
						}
					}

					if (str_replace(' ', '', strtolower($SpreadsheetName)) == 'niftytrend') {
						$this->bindByParam(':short_term', $Spreadsheetdata->sheets[$sheet]['cells'][$i][1]);
						$this->bindByParam(':intermediate', $Spreadsheetdata->sheets[$sheet]['cells'][$i][2]);
						$this->bindByParam(':long_term', $Spreadsheetdata->sheets[$sheet]['cells'][$i][3]);
						$this->bindByParam(':high', $Spreadsheetdata->sheets[$sheet]['cells'][$i][4]);
						$this->bindByParam(':low', $Spreadsheetdata->sheets[$sheet]['cells'][$i][5]);
						if ($this->execute() === false) {
							$this->cancelTransaction();
							return false;
						}
					}

				}

			}
			/*if ($this->insertCmsUserRoles() === false) {
			$this->cancelTransaction();
			return false;
			}

			if ($this->insertCmsUserCmsAccess() === false) {
			$this->cancelTransaction();
			return false;
			}*/

			$this->endTransaction();
			return true;
		} else {

			$this->cancelTransaction();
			return false;
		}
	}

	protected function inactivateRecord() {
		$this->_modelQuery = 'UPDATE cms_users set status="inactive" where cms_id=:cms_id';
		$this->query($this->_modelQuery);
		$this->bindByValue(':cms_id', $this->_rtbNewsletterId, PDO::PARAM_INT);
		if ($this->execute()) {
			return true;
		} else {
			return false;
		}
	}

	protected function updateRecord() {
		$this->beginTransaction();
		$this->_modelQuery = 'UPDATE cms_users set `employee_id` = :employee_id,`employee_name` = :employee_name,`mail` = :mail,`profile` = :profile,`contact_no` = :contact_no,`extn_no` = :extn_no,`designation` = :designation,`status` = :status,`created_by` = :created_by where cms_id=:cms_id';
		$this->query($this->_modelQuery);
		$this->_rtbNewsletterId = self::$_rtbNewsletterFields['cms_id']['fieldValue'];
		foreach (self::$_rtbNewsletterFields as $key => $value) {
			if (!empty($value['skip'])) {
				if (in_array('update', $value['skip']) === true) {
					continue;
				}
			}
			if ($key == 'site_id' || $key == 'role_id') {
				continue;
			}
			$this->bindByValue($key, $value['fieldValue']);
		}
		$this->bindByValue('created_by', 1);
		if ($this->execute()) {
			if ($this->deleteCmsUserRoles() === false) {
				$this->cancelTransaction();
				return false;
			}

			if ($this->insertCmsUserRoles() === false) {
				$this->cancelTransaction();
				return false;
			}

			if ($this->deleteCmsUserCmsAccess() === false) {
				$this->cancelTransaction();
				return false;
			}

			if ($this->insertCmsUserCmsAccess() === false) {
				$this->cancelTransaction();
				return false;
			}

			$this->endTransaction();
			return true;

		} else {

			$this->cancelTransaction();
			return false;

		}
	}
}
?>
