<?php
require_once _CONST_CLASS_PATH . 'class.database.php';
require_once _CONST_CLASS_PATH . 'class.crop.php';
class ImageModel extends Database {

	private $_modelQuery = '';
	private $_queryResult = '';
	private $_returnStatus = '';

	public function __construct($cruidId = NULL, $params = array()) {
		parent::__construct();
	}

	protected function insertImageDetails($image_name, $keywords, $original_img, $resized_list) {
		$this->_modelQuery = 'INSERT INTO `image_bank` (`image_name`,`image_keywords`,`image_original`,`image_1600`,`image_1280`,`image_615`,`image_300`,`image_100`,`image_77`,`image_uploaded_by`) VALUES (:image_name,:image_keywords,:image_original,:image_1600,:image_1280,:image_615,:image_300,:image_100,:image_77,:image_uploaded_by)';
		$this->query($this->_modelQuery);
		$this->bindByValue('image_name', $image_name);
		$this->bindByValue('image_keywords', $keywords);
		$this->bindByValue('image_original', $original_img);
		$this->bindByValue('image_1600', $resized_list['1600']);
		$this->bindByValue('image_1280', $resized_list['1280']);
		$this->bindByValue('image_615', $resized_list['615']);
		$this->bindByValue('image_300', $resized_list['300']);
		$this->bindByValue('image_100', $resized_list['100']);
		$this->bindByValue('image_77', $resized_list['77']);
		$this->bindByValue('image_uploaded_by', base64_decode($_SESSION['_cmsId']));
		if ($this->execute()) {
			return $this->lastInsertId();
		} else {
			return false;
		}
	}

	protected function getImageDetailsById($img_id) {
		$this->_modelQuery = 'select * from `image_bank` where image_id=:image_id';
		$this->query($this->_modelQuery);
		$this->bindByValue('image_id', $img_id);
		return $this->resultset();
	}

	protected function getImageCount($search = array()) {
		$where_condition = array();
		if (isset($search['image_keywords']) && $search['image_keywords'] != '') {
			$where_condition[] = ' image_keywords like "%' . $search['image_keywords'] . '%"';
		}

		if (isset($search['image_name']) && $search['image_name'] != '') {
			$where_condition[] = ' image_name like "%' . $search['image_name'] . '%"';
		}

		if (!empty($where_condition)) {
			$where_condition = 'where ' . implode(' OR ', $where_condition);
		} else {
			$where_condition = '';
		}

		if (isset($search['status'])) {
			if ($where_condition == '') {
				$where_condition .= ' where status = "' . $search['status'] . '"';
			} else {
				$where_condition .= ' and status = "' . $search['status'] . '"';
			}
		}

		if (isset($search['date_range']) && !empty($search['date_range'][0]) && !empty($search['date_range'][1])) {
			if ($where_condition == '') {
				$where_condition .= ' where modified_date BETWEEN "' . $search['date_range'][0] . '" and "' . $search['date_range'][1] . '"';
			} else {
				$where_condition .= ' and modified_date BETWEEN "' . $search['date_range'][0] . '" and "' . $search['date_range'][1] . '"';
			}
		}
		$this->_modelQuery = 'select count(1) as cnt from image_bank ' . $where_condition;
		$this->query($this->_modelQuery);
		return $this->single();
	}

	protected function getImageList($order, $offset, $limit, $search = array()) {
		$where_condition = array();
		if (isset($search['image_keywords']) && $search['image_keywords'] != '') {
			$where_condition[] = ' image_keywords like "%' . $search['image_keywords'] . '%"';
		}

		if (isset($search['image_name']) && $search['image_name'] != '') {
			$where_condition[] = ' image_name like "%' . $search['image_name'] . '%"';
		}

		if (!empty($where_condition)) {
			$where_condition = 'where ' . implode(' OR ', $where_condition);
		} else {
			$where_condition = '';
		}

		if (isset($search['status'])) {
			if ($where_condition == '') {
				$where_condition .= ' where status = "' . $search['status'] . '"';
			} else {
				$where_condition .= ' and status = "' . $search['status'] . '"';
			}
		}

		if (isset($search['date_range']) && !empty($search['date_range'][0]) && !empty($search['date_range'][1])) {
			if ($where_condition == '') {
				$where_condition .= ' where modified_date BETWEEN "' . $search['date_range'][0] . '" and "' . $search['date_range'][1] . '"';
			} else {
				$where_condition .= ' and modified_date BETWEEN "' . $search['date_range'][0] . '" and "' . $search['date_range'][1] . '"';
			}
		}

		$this->_modelQuery = 'select modified_date, image_id, image_name, image_keywords, image_original, image_1600, image_1280, image_615, image_300, image_100, image_77, status  from image_bank ' . $where_condition . ' order by modified_date ' . $order . ' limit ' . $offset . ',' . $limit . '';
		$this->query($this->_modelQuery);

		return $this->resultset();
	}

	protected function getImageDetails($order, $offset, $limit, $search = array()) {
		$total = $this->getImageCount($search);
		$imageList = $this->getImageList($order, $offset, $limit, $search);
		foreach ($imageList as $key => $value) {
			$imageList[$key]['modified_date'] = date('d-m-Y H:i:s', strtotime($value['modified_date']));
		}
		return json_encode(array("total" => (int) $total['cnt'], "rows" => $imageList));
	}

	protected function activateImage($image_id) {
		$this->_modelQuery = 'UPDATE image_bank set status="active" where image_id=:image_id';
		$this->query($this->_modelQuery);
		$this->bindByValue('image_id', $image_id);
		if ($this->execute()) {
			return true;
		} else {
			return false;
		}
	}

	protected function deleteImage($image_id) {
		$img_details = $this->getImageDetailsById($image_id);
		$this->_modelQuery = 'DELETE from image_bank where status="inactive" and image_id=:image_id';
		$this->query($this->_modelQuery);
		$this->bindByValue('image_id', $image_id);
		$this->execute();
		if ($this->rowCount() == 1) {
			unlink(_CONST_WEB_ROOT_PATH . $img_details[0]['image_original']);
			unlink(_CONST_WEB_ROOT_PATH . $img_details[0]['image_1600']);
			unlink(_CONST_WEB_ROOT_PATH . $img_details[0]['image_1280']);
			unlink(_CONST_WEB_ROOT_PATH . $img_details[0]['image_615']);
			unlink(_CONST_WEB_ROOT_PATH . $img_details[0]['image_300']);
			unlink(_CONST_WEB_ROOT_PATH . $img_details[0]['image_100']);
			unlink(_CONST_WEB_ROOT_PATH . $img_details[0]['image_77']);
			return true;
		} else {
			return false;
		}
	}

}
?>
