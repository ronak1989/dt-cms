<?php
require_once _CONST_CLASS_PATH . 'class.database.php';
require_once _CONST_CLASS_PATH . 'class.formrender.php';
class roleModel extends Database {
	private $_modelQuery = '';
	private $_queryResult = '';
	private $_returnData = NULL;
	private $_formRender = NULL;
	private $_roleId = NULL;
	protected static $_roleFields = NULL;
	public function __construct($roleId = NULL, $roleParams = array()) {
		parent::__construct();
		$this->_roleId = $roleId;
		self::$_roleFields = $roleParams;
	}

	private function getDetails() {
		$this->_modelQuery = 'SELECT roles.role_id, roles.role_category, roles.role_name, roles.status, cms_users.employee_name, roles.created_date, roles.modified_date FROM roles JOIN cms_users WHERE roles.created_by = cms_users.cms_id';
		$this->query($this->_modelQuery);
		return $this->resultset();
	}

	private function getDetailsById() {
		$this->_modelQuery = 'SELECT role_id, role_category, role_name, status FROM roles where role_id = :role_id';
		$this->query($this->_modelQuery);
		$this->bindByValue('role_id', $this->_roleId);
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
												<td class=" ">' . $value['role_id'] . '</td>
												<td class=" ">' . $value['role_category'] . '</td>
												<td class=" ">' . $value['role_name'] . '</td>
												<td class=" ">' . $value['status'] . '</td>
												<td class=" ">' . $value['name'] . '</td>
												<td class="a-right a-right ">' . $value['created_date'] . '</td>
												<td class="a-right a-right ">' . $value['modified_date'] . '</td>
												<td class=" last">
													<a class="btn btn-info btn-xs" href="' . $genericUrls['edit'] . '/' . $value['role_id'] . '"><i class="fa fa-pencil"></i> Edit </a>
													<form method="POST" action="' . $genericUrls['delete'] . '/' . $value['role_id'] . '" accept-charset="UTF-8" style="display:inline">
														<button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#confirmDelete" data-title="' . $genericUrls['confirmationModal']['delete']['title'] . ' - <b>' . $value['role_name'] . '</b>" data-message="' . $genericUrls['confirmationModal']['delete']['message'] . '">
															<i class="glyphicon glyphicon-trash"></i> Disable
														</button>
													</form>
												</td>
											</tr>';
		}
		return $this->_returnData;
	}

	protected function loadValues() {
		$this->_fieldList = self::$_roleFields;
		$this->_queryResult = $this->getDetailsById();
		foreach ($this->_queryResult[0] as $key => $value) {
			self::$_roleFields[$key]['fieldValue'] = $value;
		}
	}

	protected function getRoleForm() {
		$this->_formRender = new FromRender(self::$_roleFields);
		return $this->_formRender->getForm();
	}

	protected function saveDetails() {
		$this->_modelQuery = 'INSERT INTO roles (`role_category`,`role_name`,`status`,`created_by`) VALUES (:role_category,:role_name,:status,:created_by)';
		$this->query($this->_modelQuery);
		foreach (self::$_roleFields as $key => $value) {
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
		$this->_modelQuery = 'UPDATE roles set status="inactive" where role_id=:role_id';
		$this->query($this->_modelQuery);
		$this->bindByValue('role_id', $this->_roleId, PDO::PARAM_INT);
		if ($this->execute()) {
			return true;
		} else {
			return false;
		}
	}

	protected function updateRecord() {
		$this->_modelQuery = 'UPDATE roles set `role_category` = :role_category,`role_name` = :role_name,`status` = :status,`created_by`= :created_by where role_id=:role_id';
		$this->query($this->_modelQuery);

		foreach (self::$_roleFields as $key => $value) {
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
