<?php
require_once _CONST_MODEL_PATH . 'editorModel.php';
class NewsModel extends EditorModel {

	private $_modelQuery = '';
	private $_queryResult = '';

	public function __construct($cmsUserId = NULL, $cmsUserParams = array()) {
		parent::__construct();
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
			if (isset($search['headline']) && $search['headline'] != '') {
				$where_condition[] .= ' headline like "%' . $search['headline'] . '%"';
			}
		}
		if (!empty($where_condition)) {
			$where_condition = 'where ' . implode(' and ', $where_condition);
		}

		$this->_modelQuery = 'select modified_date, autono, headline, category_id, sub_category_id  from news_unpublish ' . $where_condition . ' order by modified_date ' . $order . ' limit ' . $offset . ',' . $limit . '';
		$this->query($this->_modelQuery);

		return $this->resultset();
	}

	protected function getNewsDetails($order, $offset, $limit, $search = array()) {
		$total = $this->getNewsCount($search);
		$userList = $this->getNewsList($order, $offset, $limit, $search);
		$category = $this->getNewsCategory();
		$prev_cat = NULL;
		foreach ($userList as $key => $value) {
			if ($prev_cat != $value['category_id']) {
				$prev_cat = $value['category_id'];
				$sub_category = $this->getNewsSubCategory($value['category_id']);
			}
			$userList[$key]['modified_date'] = date('d-m-Y H:i:s', strtotime($value['modified_date']));
			$userList[$key]['category_name'] = $category[$value['category_id']];

			$userList[$key]['sub_category_name'] = $sub_category[$value['sub_category_id']];
		}
		return json_encode(array("total" => (int) $total['cnt'], "rows" => $userList));
	}

	protected function getRankedStoryDetails($type) {
		$this->_modelQuery = 'select nup.modified_date, nup.autono, nup.headline, nup.category_id, nup.sub_category_id, nr.rank, nr.caption  from news_unpublish nup INNER JOIN news_rank nr ON nr.autono = nup.autono where nr.type="' . $type . '" order by nr.rank';
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
			if ($this->_queryResult[$key]['caption'] == null) {
				$this->_queryResult[$key]['caption'] = '';
			}
			$this->_queryResult[$key]['sub_category_name'] = $sub_category[$value['sub_category_id']];
		}
		return json_encode(array("total" => (int) $total, "rows" => $this->_queryResult));
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

		$this->_modelQuery = 'select modified_date, autono, autono as id, headline, category_id, sub_category_id  from news_unpublish ' . $where_condition . ' order by modified_date ' . $order . ' limit ' . $offset . ',' . $limit . '';
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

			$userList[$key]['sub_category_name'] = $sub_category[$value['sub_category_id']];
		}
		return json_encode(array("total" => (int) $total['cnt'], "rows" => $userList));
	}
}
?>
