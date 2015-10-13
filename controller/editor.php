<?php
require_once _CONST_MODEL_PATH . $controller_name . 'Model.php';
class Editor extends EditorModel {
	private $access_roles = array();
	private $_editorModel = NULL;
	static $pageTitle = 'Editor';
	static $pageSubTitle = '';
	private $_operationStatus = NULL;

	private $categoryId = NULL;

	/**NEWS ARTICLE PARAMS**/
	private $articleParams = array(
		'articleId' => NULL,
		'heading' => NULL,
		'sms_heading' => NULL,
		'summary' => NULL,
		'news_content' => NULL,
		'uploaded_attachments' => NULL,
		'publish_date' => NULL,
		'mod_date' => NULL,
		'author_name' => NULL,
		'author_id' => NULL,
		'publisher_name' => NULL,
		'publisher_id' => NULL,
		'news_category' => NULL,
		'news_subcategory' => NULL,
		'news_source' => NULL,
		'keywords' => NULL,
		'articleImageId' => NULL,
		'assign_to_production' => false,
		'publish' => '0',
		'transfer_to_newspublish_tbl' => '0',
		'related_story' => NULL,
		'last_updated_by' => NULL,
		'search' => NULL,
	);

	public function __construct($id = NULL, $params = array()) {
		$this->_editorModel = new editorModel(NULL, NULL);
		$this->articleParams['last_updated_by'] = base64_decode($_SESSION['_cmsId']);
		if (isset($params['category_id'])) {$this->categoryId = $params['category_id'];}

		if (isset($id)) {$this->articleParams['articleId'] = $id;}
		if (isset($params['articleId'])) {$this->articleParams['articleId'] = $params['articleId'];}
		if (isset($params['heading'])) {$this->articleParams['heading'] = $params['heading'];}
		if (isset($params['sms_heading'])) {$this->articleParams['sms_heading'] = $params['sms_heading'];}
		if (isset($params['summary'])) {$this->articleParams['summary'] = $params['summary'];}
		if (isset($params['news_content'])) {$this->articleParams['news_content'] = $params['news_content'];}
		if (isset($params['uploaded_attachments'])) {$this->articleParams['uploaded_attachments'] = $params['uploaded_attachments'];}
		if (isset($params['publish_date'])) {$this->articleParams['publish_date'] = date('Y-m-d H:i:s', strtotime($params['publish_date']));}
		if (isset($params['mod_date'])) {$this->articleParams['mod_date'] = date('Y-m-d H:i:s', strtotime($params['mod_date']));}
		if (isset($params['author_name'])) {$this->articleParams['author_name'] = $params['author_name'];}
		if (isset($params['author_id'])) {$this->articleParams['author_id'] = $params['author_id'];}
		if (isset($params['publisher_name'])) {$this->articleParams['publisher_name'] = $params['publisher_name'];}
		if (isset($params['publisher_id'])) {$this->articleParams['publisher_id'] = $params['publisher_id'];}
		if (isset($params['news_category'])) {$this->articleParams['news_category'] = $params['news_category'];}
		if (isset($params['news_subcategory'])) {$this->articleParams['news_subcategory'] = $params['news_subcategory'];}
		if (isset($params['news_source'])) {$this->articleParams['news_source'] = $params['news_source'];}
		if (isset($params['keywords'])) {$this->articleParams['keywords'] = $params['keywords'];}
		if (isset($params['articleImageId'])) {$this->articleParams['articleImageId'] = $params['heading'];}
		if (isset($params['related_story'])) {$this->articleParams['related_story'] = $params['related_story'];}
		if (isset($params['search'])) {$this->articleParams['search'] = $params['search'];}
		if (isset($params['publish']) && $params['publish'] == true) {
			$this->articleParams['publish'] = 1;
			$this->articleParams['transfer_to_newspublish_tbl'] = 1;
		}
	}

	private function redirect($status, $redirectUrl) {
		http_response_code($status);
		header("Location: " . $redirectUrl);
	}

	public function compose() {
		self::$pageSubTitle = 'Compose New Article';
		if (isset($this->articleParams['articleId'])) {
			$this->articleParams = $this->_editorModel->getArticleDetails($this->articleParams);
			if ($this->articleParams['publish'] == 1) {
				$this->articleParams['publish'] = 'checked';
			} else {
				$this->articleParams['publish'] = '';
			}
			if ($this->articleParams['publisher_id'] == 0) {
				$this->articleParams['publisher_id'] = NULL;
			}
		} else {
			$this->articleParams['author_id'] = base64_decode($_SESSION['_cmsId']);
			$this->articleParams['author_name'] = base64_decode($_SESSION['_employeeName']);
		}

		$data['mainCategory'] = $this->_editorModel->getNewsCategory();
		$data['newsSource'] = $this->_editorModel->getNewsSource();
		require_once _CONST_VIEW_PATH . 'editor.tpl.php';
	}

	public function savearticle() {
		$data['mainCategory'] = $this->_editorModel->getNewsCategory();
		$data['newsSource'] = $this->_editorModel->getNewsSource();
		if ($this->articleParams['articleId'] != '') {
			$this->_operationStatus = $this->_editorModel->updateNewsArticle($this->articleParams);
			if ($this->_operationStatus !== false) {
				$this->redirect(303, '/news/editor/compose/' . $this->articleParams['articleId']);
			} else {
				echo 'error';
			}
		} else {
			$this->_operationStatus = $this->_editorModel->saveNewsArticle($this->articleParams);
			if ($this->_operationStatus !== false) {
				$this->redirect(303, '/news/editor/compose/' . $this->_operationStatus);
			} else {
				echo 'error';
			}
		}
	}

	public function loadsubcategories() {
		echo json_encode($this->_editorModel->getNewsSubCategory($this->categoryId), JSON_FORCE_OBJECT);
	}

	public function uploadAttachment() {
		$upload_handler = new UploadHandler();
	}
}
?>
