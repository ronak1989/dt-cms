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

	protected function getImageDetails($img_id) {
		$this->_modelQuery = 'select * from `image_bank` where image_id=:image_id';
		$this->query($this->_modelQuery);
		$this->bindByValue('image_id', $img_id);
		return $this->resultset();
	}
}
?>
