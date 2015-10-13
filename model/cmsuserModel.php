<?php
require_once _CONST_CLASS_PATH . 'class.database.php';
require_once _CONST_CLASS_PATH . 'class.formrender.php';
require_once _CONST_CLASS_PATH . 'swiftmailer/lib/swift_required.php';
class cmsUserModel extends Database {
	private $_modelQuery = '';
	private $_queryResult = '';
	private $_returnData = NULL;
	private $_formRender = NULL;
	private $_cmsUserId = NULL;
	protected static $_cmsUserFields = NULL;

	public function __construct($cmsUserId = NULL, $cmsUserParams = array()) {
		parent::__construct();
		$this->_cmsUserId = $cmsUserId;
		self::$_cmsUserFields = $cmsUserParams;
	}

	private function sendCmsUserRegistrationMailer($user_id, $password) {
		$subject = 'Dalal Times CMS Access';
		$from = array('subscription@dalaltimes.com' => 'Dalal Times');
		$to = array(
			$user_id => '',
		);
		$html = '<!DOCTYPE HTML>
              <html>
              <head>
              <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
              <title>Untitled Document</title>
              </head>

              <body >
              <div style="width:650px;margin: 0px auto;padding-top:20px;border:1px solid #e1e1e1;font-family:Verdana;font-size:12px;">
              <div style="margin:0 25px;">
                  <div style="display:inline-block;vertical-align:middle;width:49%;">
                      <div style="float:left;">
                          <img src="http://magazine.dalaltimes.com/public/images/mailer-dtlogo.png" style="vertical-align:middle;display:inline-block; text-align:right;">
                      </div>
                  </div>
              </div>
              <div style="margin:0 25px;">
                <div style="margin-top:40px;text-align:center;border-bottom:1px solid #e1e1e1;color:#00a7dd; font-size:20px; text-transform:uppercase;">
                    New User Confirmation
                  </div>
                  <div style="color:#434343;">
                  <p>Your account has sucessfully been created for the Dalaltimes CMS. Please use the credentials given below to access the CMS</p>
                	<p>
                			User ID – [[USER-ID]]
                        New Password – [[NEW-PASSWORD]]
                      </p>
                  <p>You can change your password by logging in to your account </p>
                  </div>
              </div>

              </div>
              </body>
              </html>';
		$html = str_replace(array('[[USER-ID]]', '[[NEW-PASSWORD]]'), array($user_id, $password), $html);
		$transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
		$transport->setUsername('ronak.shah@dalaltimes.com');
		$transport->setPassword('0-8np7jSlC_pDxQNp4JPSA');

		$swift = Swift_Mailer::newInstance($transport);

		$message = new Swift_Message($subject);
		$message->setFrom($from);
		$message->setBody($html, 'text/html');
		$message->setTo($to);

		if ($recipients = $swift->send($message, $failures)) {
			return true;
		} else {
			return false;
		}

	}

	private function deleteCmsUserRoles() {
		$this->_modelQuery = 'DELETE FROM user_roles WHERE cms_id=:cms_id';
		$this->query($this->_modelQuery);
		$this->bindByValue('cms_id', $this->_cmsUserId);
		return $this->execute();
	}

	private function deleteCmsUserCmsAccess() {
		$this->_modelQuery = 'DELETE FROM cms_access WHERE cms_id=:cms_id';
		$this->query($this->_modelQuery);
		$this->bindByValue('cms_id', $this->_cmsUserId);
		return $this->execute();
	}

	private function insertCmsUserRoles() {
		$_counter = 0;
		$_tmpCnt = count(self::$_cmsUserFields['role_id']['fieldValue']);
		$this->_modelQuery = 'INSERT INTO user_roles (`cms_id`,`role_id`,`created_by`) VALUES (:cms_id,:role_id,:created_by)';
		$this->query($this->_modelQuery);
		$this->bindByParam(':cms_id', $this->_cmsUserId);
		$this->bindByParam(':created_by', 1);
		do {
			$this->bindByParam(':role_id', self::$_cmsUserFields['role_id']['fieldValue'][$_counter]);
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
		$_tmpCnt = count(self::$_cmsUserFields['site_id']['fieldValue']);
		$this->_modelQuery = 'INSERT INTO cms_access (`site_id`,`cms_id`,`created_by`) VALUES (:site_id,:cms_id,:created_by)';
		$this->query($this->_modelQuery);
		$this->bindByParam(':cms_id', $this->_cmsUserId);
		$this->bindByParam(':created_by', 1);
		do {
			$this->bindByParam(':site_id', self::$_cmsUserFields['site_id']['fieldValue'][$_counter]);
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
		$this->bindByValue('cms_id', $this->_cmsUserId);
		return $this->resultset();
	}

	private function getSiteList($type = NULL) {
		$column_name = 'site_id, site_name';
		if ($type == 'create') {
			$column_name = 'site_id as val ,site_name as opt';
		}
		$this->_modelQuery = 'SELECT ' . $column_name . ' FROM site_master where status = :status';
		$this->query($this->_modelQuery);
		$this->bindByValue('status', 'active');
		return $this->resultset();
	}

	private function getUserRoles($type = NULL) {
		$column_name = 'role_category, role_id ,role_name';
		if ($type == 'create') {
			$column_name = 'role_category as optgroup, role_id as val ,role_name as opt';
		}
		$this->_modelQuery = 'SELECT ' . $column_name . ' FROM roles where status = :status order by role_category asc';
		$this->query($this->_modelQuery);
		$this->bindByValue('status', 'active');
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
		$this->_fieldList = self::$_cmsUserFields;
		$this->_queryResult = $this->getDetailsById();
		foreach ($this->_queryResult[0] as $key => $value) {
			if ($key == 'site_id' || $key == 'role_id') {
				$_tmpvar = NULL;
				$_tmpvar = explode(',', $this->_queryResult[0][$key]);
				self::$_cmsUserFields[$key]['fieldValue'] = $_tmpvar;
			} else {
				self::$_cmsUserFields[$key]['fieldValue'] = $value;
			}
		}
	}

	protected function getCmsUserForm() {
		self::$_cmsUserFields['site_id']['selectOptions'] = $this->getSiteList('create');
		self::$_cmsUserFields['role_id']['selectOptions'] = $this->getUserRoles('create');
		$this->_formRender = new FromRender(self::$_cmsUserFields);
		return $this->_formRender->getForm();
	}

	protected function saveDetails() {
		$cmsSiteAccess = array();
		$cmsRoleAccess = array();
		$this->beginTransaction();
		$this->_modelQuery = 'INSERT INTO cms_users (`employee_id`,`employee_name`,`mail`,`password`,`profile`,`contact_no`,`extn_no`,`designation`,`status`,`created_by`) VALUES (:employee_id,:employee_name,:mail,:password,:profile,:contact_no,:extn_no,:designation,:status,:created_by)';
		$this->query($this->_modelQuery);
		foreach (self::$_cmsUserFields as $key => $value) {
			if (!empty($value['skip'])) {
				if (in_array('insert', $value['skip']) === true) {
					continue;
				}
			}
			if ($key == 'site_id' || $key == 'role_id') {
				continue;
			}
			if ($value['fieldValue'] == '' || $value['fieldValue'] == NULL) {
				$value['fieldValue'] = NULL;
			}
			if ($key == 'password') {
				$user_password = $value['fieldValue'];
				$this->bindByValue($key, password_hash($value['fieldValue'], PASSWORD_BCRYPT));
			} else {
				if ($key == 'mail') {
					$user_id = $value['fieldValue'];
				}
				$this->bindByValue($key, $value['fieldValue']);
			}
		}
		$this->bindByValue('created_by', 1);
		if ($this->execute()) {
			$this->_cmsUserId = $this->lastInsertId();

			if ($this->insertCmsUserRoles() === false) {
				$this->cancelTransaction();
				return false;
			}

			if ($this->insertCmsUserCmsAccess() === false) {
				$this->cancelTransaction();
				return false;
			}
			$this->sendCmsUserRegistrationMailer($user_id, $user_password);
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
		$this->bindByValue(':cms_id', $this->_cmsUserId, PDO::PARAM_INT);
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
		$this->_cmsUserId = self::$_cmsUserFields['cms_id']['fieldValue'];
		foreach (self::$_cmsUserFields as $key => $value) {
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
