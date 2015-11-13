<?php
require_once _CONST_MODEL_PATH . $controller_name . 'Model.php';
class Image extends ImageModel {
	private $access_roles = array();
	private $_imageModel = NULL;
	private $limit = 10;
	private $offset = 0;
	private $order = "desc";
	private $searchParams = array();
	private $image_id = NULL;

	static $pageTitle = 'IMAGE SECTION';
	static $pageSubTitle = '';
	private $columnHeadings = array('modified_date' => 'LAST MODIFIED DATE', 'autono' => 'AUTO NO', 'headline' => 'HEADLINE', 'operations' => array('data-title' => 'Actions', 'data-events' => 'operationEvents', 'data-formatter' => 'operationFormatter', 'data-width' => '20%', 'data-align' => 'center'));

	private $db = NULL;
	public function __construct($id = NULL, $params = array()) {
		$this->image_id = $id;
		if (isset($_GET['limit'])) {$this->limit = $_GET['limit'];}
		if (isset($_GET['offset'])) {$this->offset = $_GET['offset'];}
		if (isset($_GET['order'])) {$this->order = $_GET['order'];}
		if (isset($_GET['status'])) {$this->searchParams['status'] = $_GET['status'];}
		if (isset($_GET['image_keywords'])) {$this->searchParams['image_keywords'] = $_GET['image_keywords'];}
		if (isset($_GET['image_name'])) {$this->searchParams['image_name'] = $_GET['image_name'];}
		if (isset($_GET['publish'])) {$this->searchParams['publish_status'] = $_GET['publish'];}
		if (isset($_GET['autono'])) {$this->searchParams['autono'] = $_GET['autono'];}
		if (isset($_GET['headline'])) {$this->searchParams['headline'] = $_GET['headline'];}
		if (isset($_GET['subcategory_id'])) {$this->searchParams['subcategory_id'] = $_GET['subcategory_id'];}
		if (isset($_GET['modified_date']) && $_GET['modified_date'] != '') {
			$this->searchParams['date_range'] = explode(' - ', $_GET['modified_date']);
			$this->searchParams['date_range']['0'] = date('Y-m-d H:i:s', strtotime($this->searchParams['date_range']['0'] . ' 00:00:00'));
			$this->searchParams['date_range']['1'] = date('Y-m-d H:i:s', strtotime($this->searchParams['date_range']['1'] . ' 23:59:59'));
		}
		$this->_imageModel = new ImageModel(NULL, NULL);
	}

	public function getImageUploadList() {
		$data['operation'] = 'new';
		$data['image_size'][1280] = 'http://placehold.it/1280x720';
		$data['image_size'][615] = 'http://placehold.it/615x346';
		$data['image_size'][300] = 'http://placehold.it/300x169';
		$data['image_size'][100] = 'http://placehold.it/100x56';
		$data['image_size'][77] = 'http://placehold.it/77x43';
		require_once _CONST_VIEW_PATH . 'image.tpl.php';
	}

	public function uploadNewImage() {
		if (isset($_POST['img_type']) && $_POST['img_type'] == 'resize') {
			$src = $_POST['img_src'];
			$data = $_POST['img_data'];
			$file = $_FILES['img_file'];
			$news_autono = $_POST['news_autono'];
			$orgimgName = $imgName = trim($_POST['img_name']);
			$replace = array('!', '~', '`', '@', '#', '$', '%', '^', '&', '*', '*', '(', ')', '-', '_', '+', '=', '{', '}', ':', ';', "\"", "'", ",", "<", ">", "?", "/", ".", "|", "\\");
			$imgName = strtolower(str_replace($replace, " ", $imgName));
			$imgName = str_replace("  ", " ", $imgName);
			$imgName = str_replace(" ", "-", $imgName);
			$imgTags = $_POST['img_tags'];
			$img_courtesy = $_POST['img_courtesy'];
			$operation = 'resize';
			$imgDetails = array();
		} else {
			$image_id = $_POST['avatar_image_id'];
			$imgDetails = $this->_imageModel->getImageDetailsById($image_id);
			$src = $_POST['avatar_src'];
			$data = $_POST['avatar_data'];
			$file = $_FILES['avatar_file'];
			$destFile = $_POST['avatar_image_width'];
			$operation = 'crop';
			$imgDetails = $this->_imageModel->getImageDetailsById($image_id);
		}

		$crop = new CropAvatar($src, $data, $file, $operation, $imgName, $imgTags, $imgDetails, $destFile, $news_autono);
		if ($operation == 'resize') {
			if (is_null($crop->getMsg())) {
				$image_id = $this->_imageModel->insertImageDetails($orgimgName, $imgTags, $crop->getResult(), $crop->getResizeFileName(), $news_autono, $img_courtesy);

			}
		}
		$response = array(
			'state' => 200,
			'message' => $crop->getMsg(),
			'result' => $crop->getResult(),
			'resizedList' => $crop->getResizeFileName(),
			'image_id' => $image_id,
			'image_name' => $orgimgName,
			'image_tags' => $imgTags,
		);

		echo json_encode($response);

	}

	public function getImage() {
		self::$pageTitle = 'Approved Images';
		$data_url = '/image/latest/list';
		$defaultParams['status'] = 'active';
		require_once _CONST_VIEW_PATH . 'imagelist.tpl.php';
	}

	public function getImageGallery() {
		self::$pageTitle = 'Image Gallery';
		$data_url = '/image/latest/list';
		$defaultParams['status'] = 'active';
		$image_gallery = '1';
		require_once _CONST_VIEW_PATH . 'imagelist.tpl.php';
	}

	public function getPendingImage() {
		self::$pageTitle = 'Images Pending for Approval';
		$data_url = '/image/latest/list';
		$approve_url = '/image/approve/';
		$disapprove_url = '/image/disapprove/';
		$defaultParams['status'] = 'inactive';
		require_once _CONST_VIEW_PATH . 'imagelist.tpl.php';
	}

	public function getLatestImages() {
		$data = $this->_imageModel->getImageDetails($this->order, $this->offset, $this->limit, $this->searchParams);
		echo $data;
	}

	public function approveImage() {
		if ($this->image_id == NULL) {
			echo 'fail';
		} else {
			$operation_status = $this->_imageModel->activateImage($this->image_id);
			if ($operation_status == true) {
				echo 'success';
			} else {
				echo 'fail';
			}
		}
	}

	public function disapproveImage() {
		if ($this->image_id == NULL) {
			echo 'fail';
		} else {
			$operation_status = $this->_imageModel->deleteImage($this->image_id);
			if ($operation_status == true) {
				echo 'success';
			} else {
				echo 'fail';
			}
		}
	}

	public function modifyImageUploaded() {
		$data['operation'] = 'edit';
		$imgDetails = $this->_imageModel->getImageDetailsById($this->image_id);
		$data['image_size'][1280] = $imgDetails[0]['image_1280'];
		$data['image_size'][615] = $imgDetails[0]['image_615'];
		$data['image_size'][300] = $imgDetails[0]['image_300'];
		$data['image_size'][100] = $imgDetails[0]['image_100'];
		$data['image_size'][77] = $imgDetails[0]['image_77'];
		require_once _CONST_VIEW_PATH . 'image.tpl.php';
	}

	public function updateImageUploaded() {
		$operation_status = $this->_imageModel->updateImage($this->image_id, $_POST['image_name'], $_POST['image_keywords'], $_POST['image_courtesy']);
		if ($operation_status == true) {
			echo 'success';
		} else {
			echo 'fail';
		}
	}

	public function getProductionAssignedImage() {
		$data_url = '/image/assigned-to-production/list';
		require_once _CONST_VIEW_PATH . 'productionassignedlist.tpl.php';
	}

	public function getProductionAssignedImageList() {
		$data = $this->_imageModel->getProductionAssignedImageDetails($this->order, $this->offset, $this->limit, $this->searchParams);
		echo $data;
	}
}
?>
