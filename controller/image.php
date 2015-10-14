<?php
require_once _CONST_MODEL_PATH . $controller_name . 'Model.php';
class Image extends ImageModel {
	private $access_roles = array();
	private $_imageModel = NULL;
	private $limit = 10;
	private $offset = 0;
	private $order = "desc";

	static $pageTitle = 'IMAGE SECTION';
	static $pageSubTitle = '';
	private $db = NULL;
	public function __construct($id = NULL, $params = array()) {
		$this->_imageModel = new ImageModel(NULL, NULL);
	}

	public function getImageUploadList() {
		require_once _CONST_VIEW_PATH . 'image.tpl.php';
	}

	public function uploadNewImage() {
		if (isset($_POST['img_type']) && $_POST['img_type'] == 'resize') {
			$src = $_POST['img_src'];
			$data = $_POST['img_data'];
			$file = $_FILES['img_file'];
			$orgimgName = $imgName = trim($_POST['img_name']);
			$replace = array('!', '~', '`', '@', '#', '$', '%', '^', '&', '*', '*', '(', ')', '-', '_', '+', '=', '{', '}', ':', ';', "\"", "'", ",", "<", ">", "?", "/", ".", "|", "\\");
			$imgName = str_replace($replace, " ", $imgName);
			$imgName = str_replace("  ", " ", $imgName);
			$imgName = str_replace(" ", "-", $imgName);
			$imgTags = $_POST['img_tags'];
			$operation = 'resize';
			$imgDetails = array();
		} else {
			$image_id = $_POST['avatar_image_id'];
			$imgDetails = $this->_imageModel->getImageDetails($image_id);
			$src = $_POST['avatar_src'];
			$data = $_POST['avatar_data'];
			$file = $_FILES['avatar_file'];
			$destFile = $_POST['avatar_image_width'];
			$operation = 'crop';
			$imgDetails = $this->_imageModel->getImageDetails($image_id);
		}

		$crop = new CropAvatar($src, $data, $file, $operation, $imgName, $imgTags, $imgDetails, $destFile);
		if ($operation == 'resize') {
			if (is_null($crop->getMsg())) {
				$image_id = $this->_imageModel->insertImageDetails($orgimgName, $imgTags, $crop->getResult(), $crop->getResizeFileName());
			}
		}
		$response = array(
			'state' => 200,
			'message' => $crop->getMsg(),
			'result' => $crop->getResult(),
			'resizedList' => $crop->getResizeFileName(),
			'image_id' => $image_id,
		);

		echo json_encode($response);

	}
}
?>
