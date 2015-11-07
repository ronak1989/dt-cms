<?php

require_once _CONST_MODEL_PATH . 'editorModel.php';
class NewsModel extends EditorModel {

	private $_modelQuery = '';
	private $_queryResult = '';

	public function __construct($cmsUserId = NULL, $cmsUserParams = array()) {
		parent::__construct();
		$this->_commonFunction = new CommonFunctions();
	}

	protected function getNewsCount($search = array()) {
		$where_condition = array();
		if (isset($search['publish_status'])) {
			$where_condition[] = ' publish = "' . $search['publish_status'] . '"';
		}
		if (isset($search['autono']) && $search['autono'] != '') {
			$where_condition[] .= ' autono = "' . $search['autono'] . '"';
		} else {
			if (isset($search['category_id']) && $search['category_id'] != '') {
				$where_condition[] .= ' category_id = "' . $search['category_id'] . '"';
			}
			if (isset($search['subcategory_id']) && $search['subcategory_id'] != '') {
				$where_condition[] .= ' sub_category_id = "' . $search['subcategory_id'] . '"';
			}
			if (isset($search['date_range']) && !empty($search['date_range'][0]) && !empty($search['date_range'][1])) {
				$where_condition[] .= ' modified_date BETWEEN "' . $search['date_range'][0] . '" and "' . $search['date_range'][1] . '"';
			}
			if (isset($search['exclude_autono'])) {
				if (is_array($search['exclude_autono'])) {
					$where_condition[] .= ' autono NOT IN (' . implode(",", $search['exclude_autono']) . ')';
				} else if ($search['exclude_autono'] != '') {
					$where_condition[] .= ' autono != "' . $search['exclude_autono'] . '"';
				}
			}
			if (isset($search['headline']) && $search['headline'] != '') {
				$where_condition[] .= ' headline like "%' . $search['headline'] . '%"';
			}
		}
		if (!empty($where_condition)) {
			$where_condition = 'where ' . implode(' and ', $where_condition);
		}
		$this->_modelQuery = 'select count(1) as cnt from news_unpublish ' . $where_condition;
		$this->query($this->_modelQuery);
		return $this->single();
	}

	protected function getNewsList($order, $offset, $limit, $search = array()) {
		$where_condition = array();
		if (isset($search['publish_status'])) {
			$where_condition[] = ' nu.publish = "' . $search['publish_status'] . '"';
		}
		if (isset($search['autono']) && $search['autono'] != '') {
			$where_condition[] .= ' nu.autono = "' . $search['autono'] . '"';
		} else {
			if (isset($search['category_id']) && $search['category_id'] != '') {
				$where_condition[] .= ' nu.category_id = "' . $search['category_id'] . '"';
			}
			if (isset($search['subcategory_id']) && $search['subcategory_id'] != '') {
				$where_condition[] .= ' nu.sub_category_id = "' . $search['subcategory_id'] . '"';
			}
			if (isset($search['exclude_subcategory_id']) && $search['exclude_subcategory_id'] != '') {
				$where_condition[] .= ' nu.sub_category_id NOT IN (' . implode(',', $search['exclude_subcategory_id']) . ')';
			}
			if (isset($search['exclude_autono'])) {
				if (is_array($search['exclude_autono'])) {
					$where_condition[] .= ' nu.autono NOT IN (' . implode(",", $search['exclude_autono']) . ')';
				} else if ($search['exclude_autono'] != '') {
					$where_condition[] .= ' nu.autono != "' . $search['exclude_autono'] . '"';
				}
			}
			if (isset($search['date_range']) && !empty($search['date_range'][0]) && !empty($search['date_range'][1])) {
				$where_condition[] .= ' nu.modified_date BETWEEN "' . $search['date_range'][0] . '" and "' . $search['date_range'][1] . '"';
			}
			if (isset($search['headline']) && $search['headline'] != '') {
				$where_condition[] .= ' nu.headline like "%' . $search['headline'] . '%"';
			}
		}
		if (!empty($where_condition)) {
			$where_condition = 'where ' . implode(' and ', $where_condition);
		}

		$this->_modelQuery = 'select nu.modified_date, nu.autono, nu.headline, nu.category_id, nu.sub_category_id, nu.summary, nu.source_id, ib.image_id,ib.image_name,ib.image_keywords,ib.image_name,ib.image_1600,ib.image_1280,ib.image_615,ib.image_300,ib.image_100,ib.image_77  from news_unpublish nu LEFT JOIN image_bank ib ON ib.image_id = nu.image_id ' . $where_condition . ' order by nu.publish_date ' . $order . ' limit ' . $offset . ',' . $limit . '';
		$this->query($this->_modelQuery);

		return $this->resultset();
	}

	protected function getNewsDetails($order, $offset, $limit, $search = array(), $return_type = 'json') {
		$total = $this->getNewsCount($search);
		$userList = $this->getNewsList($order, $offset, $limit, $search);
		$category = $this->getNewsCategory();
		$news_source = $this->getNewsSource();
		$prev_cat = NULL;
		foreach ($userList as $key => $value) {
			if ($prev_cat != $value['category_id']) {
				$prev_cat = $value['category_id'];
				$sub_category = $this->getNewsSubCategory($value['category_id']);
			}
			$userList[$key]['modified_date'] = date('d-m-Y H:i:s', strtotime($value['modified_date']));
			$userList[$key]['category_name'] = $category[$value['category_id']];
			$userList[$key]['category_url'] = _CONST_WEB_URL . '/' . $this->_commonFunction->sanitizeString($category[$value['category_id']]);

			$userList[$key]['sub_category_name'] = $sub_category[$value['sub_category_id']];
			$userList[$key]['news_source'] = $news_source[$value['source_id']];
			$userList[$key]['news_url'] = _CONST_WEB_URL . '/' . $value['autono'] . '/' . $this->_commonFunction->sanitizeString($value['headline']);
		}
		if ($return_type == 'json') {
			return json_encode(array("total" => (int) $total['cnt'], "rows" => $userList));
		} else {
			return array("total" => (int) $total['cnt'], "rows" => $userList);
		}

	}

	protected function getRankedStoryDetails($type, $return_type = 'json') {
		$this->_modelQuery = 'select nup.modified_date, nup.autono, nup.headline, nup.category_id, nup.sub_category_id, nr.rank, nr.caption, ib.image_id,ib.image_name,ib.image_keywords,ib.image_name,ib.image_1600,ib.image_1280,ib.image_615,ib.image_300,ib.image_100,ib.image_77  from news_unpublish nup INNER JOIN news_rank nr ON nr.autono = nup.autono INNER JOIN image_bank ib ON ib.image_id = nup.image_id where nr.type="' . $type . '" order by nr.rank';
		$this->query($this->_modelQuery);
		$this->_queryResult = $this->resultset();
		$total = count($this->_queryResult);
		$category = $this->getNewsCategory();
		$prev_cat = NULL;
		foreach ($this->_queryResult as $key => $value) {
			if ($prev_cat != $value['category_id']) {
				$prev_cat = $value['category_id'];
				$sub_category = $this->getNewsSubCategory($value['category_id']);
			}
			$this->_queryResult[$key]['modified_date'] = date('d-m-Y H:i:s', strtotime($value['modified_date']));
			$this->_queryResult[$key]['category_name'] = $category[$value['category_id']];
			$this->_queryResult[$key]['category_url'] = _CONST_WEB_URL . '/' . $this->_commonFunction->sanitizeString($category[$value['category_id']]);
			if ($this->_queryResult[$key]['caption'] == null) {
				$this->_queryResult[$key]['caption'] = '';
			}
			$this->_queryResult[$key]['sub_category_name'] = $sub_category[$value['sub_category_id']];
			$this->_queryResult[$key]['news_url'] = _CONST_WEB_URL . '/' . $value['autono'] . '/' . $this->_commonFunction->sanitizeString($value['headline']);
		}
		if ($return_type == 'json') {
			return json_encode(array("total" => (int) $total, "rows" => $this->_queryResult));
		} else {
			return array("total" => (int) $total, "rows" => $this->_queryResult);
		}

	}

	protected function updateRankedStories($rankParams) {
		$this->_modelQuery = 'INSERT INTO news_rank(type,rank, autono,caption) VALUES (:type,:rank,:autono, :caption) ON DUPLICATE KEY UPDATE autono=VALUES(autono), caption = VALUES(caption)';
		$this->query($this->_modelQuery);
		$this->bindByValue('type', $rankParams['rank_type']);
		$this->bindByValue('rank', $rankParams['rank']);
		$this->bindByValue('autono', $rankParams['rank_autono']);
		$this->bindByValue('caption', $rankParams['rank_caption']);
		if ($this->execute()) {
			echo 'success';
		} else {
			echo 'failure';
		}
	}

	protected function deleteRankedStories($rankParams) {
		$this->_modelQuery = 'DELETE from news_rank where type=:type and rank = :rank and autono = :autono';
		$this->query($this->_modelQuery);
		$this->bindByValue('type', $rankParams['rank_type']);
		$this->bindByValue('rank', $rankParams['rank']);
		$this->bindByValue('autono', $rankParams['rank_autono']);
		if ($this->execute()) {
			echo 'success';
		} else {
			echo 'failure';
		}
	}

	protected function getSearchNewsCount($search = array()) {
		$where_condition = array();
		if (isset($search['publish_status'])) {
			$where_condition[] = ' publish = "' . $search['publish_status'] . '"';
		}
		if (isset($search['autono']) && $search['autono'] != '') {
			$where_condition[] .= ' autono = "' . $search['autono'] . '"';
		}
		if (isset($search['category_id']) && $search['category_id'] != '') {
			$where_condition[] .= ' category_id = "' . $search['category_id'] . '"';
		}
		if (isset($search['subcategory_id']) && $search['subcategory_id'] != '') {
			$where_condition[] .= ' sub_category_id = "' . $search['subcategory_id'] . '"';
		}
		if (isset($search['date_range']) && !empty($search['date_range'][0]) && !empty($search['date_range'][1])) {
			$where_condition[] .= ' modified_date BETWEEN "' . $search['date_range'][0] . '" and "' . $search['date_range'][1] . '"';
		}
		if (isset($search['headline']) && $search['headline'] != '') {
			$where_condition[] .= ' headline like "%' . $search['headline'] . '%"';
		}
		if (isset($search['keywords']) && $search['keywords'] != '') {
			$where_condition[] .= ' keywords like "%' . $search['keywords'] . '%"';
		}

		if (!empty($where_condition)) {
			$where_condition = 'where (' . implode(' OR ', $where_condition) . ') and publish = "0"';
		}

		$this->_modelQuery = 'select count(1) as cnt from news_unpublish ' . $where_condition;
		$this->query($this->_modelQuery);
		return $this->single();
	}

	protected function getSearchNewsList($order, $offset, $limit, $search = array()) {
		$where_condition = array();
		if (isset($search['autono']) && $search['autono'] != '') {
			$where_condition[] = ' autono = "' . $search['autono'] . '"';
		}
		if (isset($search['category_id']) && $search['category_id'] != '') {
			$where_condition[] = ' category_id = "' . $search['category_id'] . '"';
		}
		if (isset($search['subcategory_id']) && $search['subcategory_id'] != '') {
			$where_condition[] = ' sub_category_id = "' . $search['subcategory_id'] . '"';
		}
		if (isset($search['date_range']) && !empty($search['date_range'][0]) && !empty($search['date_range'][1])) {
			$where_condition[] = ' modified_date BETWEEN "' . $search['date_range'][0] . '" and "' . $search['date_range'][1] . '"';
		}
		if (isset($search['headline']) && $search['headline'] != '') {
			$where_condition[] = ' headline like "%' . $search['headline'] . '%"';
		}
		if (isset($search['keywords']) && $search['keywords'] != '') {
			$where_condition[] = ' keywords like "%' . $search['keywords'] . '%"';
		}

		if (!empty($where_condition)) {
			$where_condition = 'where (' . implode(' OR ', $where_condition) . ') and publish = "' . $search['publish_status'] . '"';
		}

		$this->_modelQuery = 'select modified_date, autono, autono as id, headline, category_id, sub_category_id  from news_unpublish ' . $where_condition . ' order by publish_date ' . $order . ' limit ' . $offset . ',' . $limit . '';
		$this->query($this->_modelQuery);

		return $this->resultset();
	}

	protected function searchResult($order, $offset, $limit, $search = array()) {
		$total = $this->getSearchNewsCount($search);
		$userList = $this->getSearchNewsList($order, $offset, $limit, $search);
		$category = $this->getNewsCategory();
		$prev_cat = NULL;
		foreach ($userList as $key => $value) {
			if ($prev_cat != $value['category_id']) {
				$prev_cat = $value['category_id'];
				$sub_category = $this->getNewsSubCategory($value['category_id']);
			}
			$userList[$key]['modified_date'] = date('d-m-Y H:i:s', strtotime($value['modified_date']));
			$userList[$key]['category_name'] = $category[$value['category_id']];
			$userList[$key]['category_url'] = _CONST_WEB_URL . '/' . $this->_commonFunction->sanitizeString($category[$value['category_id']]);

			$userList[$key]['sub_category_name'] = $sub_category[$value['sub_category_id']];
			$userList[$key]['news_url'] = _CONST_WEB_URL . '/' . $value['autono'] . '/' . $this->_commonFunction->sanitizeString($value['headline']);
		}
		return json_encode(array("total" => (int) $total['cnt'], "rows" => $userList));
	}

	protected function getHomePageDetails() {
		$result['cover-story-details'] = $this->getRankedStoryDetails('cover story', 'array')['rows'];
		$result['hot-of-the-press'] = $this->getNewsDetails('desc', 0, 15, array('publish_status' => 1), 'array')['rows'];
		$result['forecaster'] = $this->getNewsDetails('desc', 0, 1, array('publish_status' => 1, 'subcategory_id' => 16), 'array')['rows'];
		$result['chart-of-the-day'] = $this->getNewsDetails('desc', 0, 1, array('publish_status' => 1, 'subcategory_id' => 17), 'array')['rows'];
		$result['market-widget'] = $this->getNewsDetails('desc', 0, 5, array('publish_status' => 1, 'category_id' => '1', 'exclude_sub_category_id' => array('16', '17')), 'array')['rows'];
		$result['corporate-widget'] = $this->getNewsDetails('desc', 0, 5, array('publish_status' => 1, 'category_id' => '2'), 'array')['rows'];
		$result['news-widget'] = $this->getNewsDetails('desc', 0, 5, array('publish_status' => 1, 'category_id' => '3'), 'array')['rows'];
		$result['investing-widget'] = $this->getNewsDetails('desc', 0, 5, array('publish_status' => 1, 'category_id' => '4'), 'array')['rows'];
		$result['earnings-widget'] = $this->getNewsDetails('desc', 0, 5, array('publish_status' => 1, 'category_id' => '5'), 'array')['rows'];
		$result['economy-widget'] = $this->getNewsDetails('desc', 0, 5, array('publish_status' => 1, 'category_id' => '7'), 'array')['rows'];
		/*echo '<pre>' . print_r($result) . '</pre>';
		die();*/
		return $result;
	}

	protected function getNewsWidgetDetails() {
		$result['top_10'] = $this->getRankedStoryDetails('cover story', 'array')['rows'];
		$result['latest'] = $this->getNewsDetails('desc', 0, 5, array('publish_status' => 1), 'array')['rows'];
		return $result;
	}

	protected function getCategoryDetails($order, $offset, $limit, $search = array(), $return_type = 'json') {
		$userList = $this->getNewsList($order, $offset, $limit, $search);
		$category = $this->getNewsCategory();
		$news_source = $this->getNewsSource();
		$prev_cat = NULL;
		foreach ($userList as $key => $value) {
			if ($prev_cat != $value['category_id']) {
				$prev_cat = $value['category_id'];
				$sub_category = $this->getNewsSubCategory($value['category_id']);
			}
			$userList[$key]['modified_date'] = date('d-m-Y H:i:s', strtotime($value['modified_date']));
			$userList[$key]['category_name'] = $category[$value['category_id']];
			$userList[$key]['category_url'] = _CONST_WEB_URL . '/' . $this->_commonFunction->sanitizeString($category[$value['category_id']]);

			$userList[$key]['sub_category_name'] = $sub_category[$value['sub_category_id']];
			$userList[$key]['news_source'] = $news_source[$value['source_id']];
			$userList[$key]['news_url'] = _CONST_WEB_URL . '/' . $value['autono'] . '/' . $this->_commonFunction->sanitizeString($value['headline']);
		}
		/*if ($return_type == 'json') {
		return json_encode(array("total" => (int) $total['cnt'], "rows" => $userList));
		} else {
		return array("total" => (int) $total['cnt'], "rows" => $userList);
		}*/
		//$result['categoryDetails'] = $this->getNewsDetails('desc', 0, 2, array('publish_status' => 1), 'array');
		if ($return_type == 'json') {
			$result['categoryDetails'] = json_encode(array("total" => (int) $total['cnt'], "rows" => $userList));
		} else {
			$result['categoryDetails'] = array("rows" => $userList);
		}
		return $result;
	}

	protected function getAllRankedStoryDetails($type, $return_type = 'json') {
		$this->_modelQuery = 'select nup.*, nr.rank, nr.caption, ib.image_id,ib.image_name,ib.image_keywords,ib.image_name,ib.image_1600,ib.image_1280,ib.image_615,ib.image_300,ib.image_100,ib.image_77  from news_unpublish nup INNER JOIN news_rank nr ON nr.autono = nup.autono INNER JOIN image_bank ib ON ib.image_id = nup.image_id where nr.type="' . $type . '" order by nr.rank';

		$this->query($this->_modelQuery);
		$this->_queryResult = $this->resultset();
		$total = count($this->_queryResult);
		$category = $this->getNewsCategory();
		$news_source = $this->getNewsSource();
		$prev_cat = NULL;
		$last_related_autono = array();
		foreach ($this->_queryResult as $key => $value) {
			if ($prev_cat != $value['category_id']) {
				$prev_cat = $value['category_id'];
				$sub_category = $this->getNewsSubCategory($value['category_id']);
			}
			$this->_queryResult[$key]['modified_date'] = date('d-m-Y H:i:s', strtotime($value['modified_date']));
			$this->_queryResult[$key]['category_name'] = $category[$value['category_id']];
			$this->_queryResult[$key]['news_source_name'] = $news_source[$value['source_id']];
			$this->_queryResult[$key]['category_url'] = _CONST_WEB_URL . '/' . $this->_commonFunction->sanitizeString($category[$value['category_id']]);
			if ($this->_queryResult[$key]['caption'] == null) {
				$this->_queryResult[$key]['caption'] = '';
			}
			$this->_queryResult[$key]['sub_category_name'] = $sub_category[$value['sub_category_id']];
			$this->_queryResult[$key]['news_url'] = _CONST_WEB_URL . '/' . $value['autono'] . '/' . $this->_commonFunction->sanitizeString($value['headline']);
			$last_related_autono[] = $value['autono'];

			$this->_queryResult[$key]['related-news'] = $this->getRelatedNewsWidgetDetails($last_related_autono, $value['related_story'], $value['category_id']);
			if ($this->_queryResult[$key]['related-news']['left-col']['autono'] != '') {
				$last_related_autono[] = $this->_queryResult[$key]['related-news']['left-col']['autono'];
			}

		}
		if ($return_type == 'json') {
			return json_encode(array("total" => (int) $total, "rows" => $this->_queryResult));
		} else {
			return array("total" => (int) $total, "rows" => $this->_queryResult);
		}

	}

	protected function getArticleById($autono) {
		$news_source = $this->getNewsSource();
		$result['article-details'] = $this->getArticleDetails(array('articleId' => $autono));
		$result['article-details']['news_url'] = _CONST_WEB_URL . '/' . $result['article-details']['articleId'] . '/' . $this->_commonFunction->sanitizeString($result['article-details']['heading']);
		$result['article-details']['news_source_name'] = $news_source[$result['article-details']['news_source']];
		$result['related-news'] = $this->getRelatedNewsWidgetDetails($result['article-details']['articleId'], $result['article-details']['related_story'], $result['article-details']['news_category']);
		$result['suggested-stories'] = $this->getAllRankedStoryDetails('hot of the press', 'array')['rows'];
		return $result;
	}

	protected function getRelatedNewsWidgetDetails($articleIds, $related_autono, $category_id) {
		$search_params['publish_status'] = 1;
		$search_params['category_id'] = $category_id;
		if (is_array($articleIds)) {
			$search_params['exclude_autono'] = $articleIds;
		} else {
			$search_params['exclude_autono'][] = $articleIds;
		}
		if ($related_autono != '') {
			$search_params['exclude_autono'][] = $related_autono;
		}

		$result['left-col'] = $this->getNewsDetails('desc', 0, 1, $search_params, 'array')['rows'][0];

		unset($search_params['category_id']);
		if ($related_autono == '' || $related_autono == NULL || $related_autono == '0') {
			if ($result['left-col']['autono'] != '') {
				$search_params['exclude_autono'][] = $result['left-col']['autono'];
			}
		} else {
			unset($search_params['exclude_autono']);
			$search_params['autono'] = $related_autono;
		}

		$result['right-col'] = $this->getNewsDetails('desc', 0, 1, $search_params, 'array')['rows'][0];
		return $result;
	}
}
?>
