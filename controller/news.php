<?php
require_once _CONST_CLASS_PATH . 'class.functions.php';
require_once _CONST_MODEL_PATH . $controller_name . 'Model.php';
class News extends NewsModel {
	private $access_roles = array();
	private $_newsModel = NULL;
	private $limit = 10;
	private $offset = 0;
	private $order = "desc";
	private $searchParams = array();
	private $rankParams = array();
	private $category = NULL;
	private $pg = 0;
	private $_commonFunction = NULL;
	private $_autono = NULL;

	private $columnHeadings = array('modified_date' => 'LAST MODIFIED DATE', 'autono' => 'AUTO NO', 'headline' => 'HEADLINE', 'category_name' => 'CATEGORY', 'sub_category_name' => 'SUB CATEGORY', 'operations' => array('data-title' => 'Actions', 'data-events' => 'operationEvents', 'data-formatter' => 'operationFormatter', 'data-width' => '20%', 'data-align' => 'center'));
	private $rankColumnHeadings = array('modified_date' => 'LAST MODIFIED DATE', 'autono' => 'AUTO NO', 'headline' => 'HEADLINE', 'category_name' => 'CATEGORY', 'rank' => 'RANKED', 'caption' => array('data-title' => 'Caption ', 'data-events' => 'operationEvents', 'data-formatter' => 'rankCaption'), 'operations' => array('data-title' => 'Actions', 'data-events' => 'operationEvents', 'data-formatter' => 'rankActions'));

	static $pageTitle = 'NEWS SECTION';
	static $pageSubTitle = '';
	static $socialTags = array(
		'og:title' => 'Dalaltimes',
		'og:type' => 'website',
		'og:image' => _CONST_WEB_URL . '/public/images/dalaltimes.jpg',
		'og:url' => _CONST_WEB_URL,
		'og:description' => 'Dalal Times is a research-based financial portal covering stocks, commodities, companies and the economy.  Manage your finance with our online Investment Portfolio, All Stat Pages, Stock Trading News.',
		'og:site_name' => 'Dalaltimes',
		'twitter:card' => 'summary',
		'twitter:url' => 'https://twitter.com/dalaltimes',
		'twitter:title' => 'Dalaltimes',
		'twitter:description' => 'Dalal Times is a research-based financial portal covering stocks, commodities, companies and the economy.  Manage your finance with our online Investment Portfolio, All Stat Pages, Stock Trading News.',
		'twitter:image' => _CONST_WEB_URL . '/public/images/dalaltimes.jpg',
		'twitter:site' => '@dalaltimes',
	);

	public function __construct($id = NULL, $category = NULL, $pg = 0, $params = array()) {
		$this->category = $category;
		$this->pg = $pg;
		$this->_autono = $id;
		if (isset($_GET['limit'])) {$this->limit = $_GET['limit'];}
		if (isset($_GET['offset'])) {$this->offset = $_GET['offset'];}
		if (isset($_GET['order'])) {$this->order = $_GET['order'];}
		if (isset($_GET['publish'])) {$this->searchParams['publish_status'] = $_GET['publish'];}
		if (isset($_GET['autono'])) {$this->searchParams['autono'] = $_GET['autono'];}
		if (isset($_GET['headline'])) {$this->searchParams['headline'] = $_GET['headline'];}
		if (isset($_GET['category_id'])) {$this->searchParams['category_id'] = $_GET['category_id'];}
		if (isset($_GET['subcategory_id'])) {$this->searchParams['subcategory_id'] = $_GET['subcategory_id'];}
		if (isset($_GET['modified_date']) && $_GET['modified_date'] != '') {
			$this->searchParams['date_range'] = explode(' - ', $_GET['modified_date']);
			$this->searchParams['date_range']['0'] = date('Y-m-d H:i:s', strtotime($this->searchParams['date_range']['0'] . ' 00:00:00'));
			$this->searchParams['date_range']['1'] = date('Y-m-d H:i:s', strtotime($this->searchParams['date_range']['1'] . ' 23:59:59'));
		}
		if (isset($params['rank_type'])) {$this->rankParams['rank_type'] = $params['rank_type'];}
		if (isset($params['rank_autono'])) {$this->rankParams['rank_autono'] = $params['rank_autono'];}
		if (isset($params['rank'])) {$this->rankParams['rank'] = $params['rank'];}
		if (isset($params['rank_caption'])) {$this->rankParams['rank_caption'] = $params['rank_caption'];}
		if (isset($_GET['search'])) {
			$this->searchParams['publish_status'] = 1;
			$this->searchParams['autono'] = $_GET['search'];
			$this->searchParams['headline'] = $_GET['search'];
			$this->searchParams['keywords'] = $_GET['search'];
		}
		$this->_commonFunction = new CommonFunctions();
		$this->_newsModel = new NewsModel(NULL, NULL);
	}

	public function getNews() {
		$data_url = '/news/latest/list';
		$data['mainCategory'] = '<option value="">Please select Category to Search</option>';
		foreach (parent::getNewsCategory() as $key => $value) {
			$data['mainCategory'] .= '<option value="' . $key . '">' . ucwords(strtolower($value)) . '</option>';
		}
		require_once _CONST_VIEW_PATH . 'newslist.tpl.php';
	}

	public function getLatestNews() {
		$data = $this->_newsModel->getNewsDetails($this->order, $this->offset, $this->limit, $this->searchParams);
		echo $data;
	}

	public function getCoverStoryPage() {
		$this->columnHeadings['ranking_list'] = array('data-title' => 'RANK', 'data-events' => 'operationEvents', 'data-formatter' => 'rankBox');
		$data_url = '/news/latest/list';
		$rank_url = '/ranked/cover-story/news';
		$update_url = '/rank/update';
		$delete_url = '/rank/remove';
		$rank_type = 'cover story';
		$data['mainCategory'] = '<option value="">Please select Category to Search</option>';
		foreach (parent::getNewsCategory() as $key => $value) {
			$data['mainCategory'] .= '<option value="' . $key . '">' . ucwords(strtolower($value)) . '</option>';
		}
		require_once _CONST_VIEW_PATH . 'newsRank.tpl.php';
	}

	public function getHOPpage() {
		$this->columnHeadings['ranking_list'] = array('data-title' => 'RANK', 'data-events' => 'operationEvents', 'data-formatter' => 'rankBox');
		$data_url = '/news/latest/list';
		$rank_url = '/ranked/hot-of-the-press/news';
		$update_url = '/rank/update';
		$delete_url = '/rank/remove';
		$rank_type = 'hot of the press';
		$data['mainCategory'] = '<option value="">Please select Category to Search</option>';
		foreach (parent::getNewsCategory() as $key => $value) {
			$data['mainCategory'] .= '<option value="' . $key . '">' . ucwords(strtolower($value)) . '</option>';
		}
		require_once _CONST_VIEW_PATH . 'newsRank.tpl.php';
	}

	public function getRankedCoverStory() {
		$data = $this->_newsModel->getRankedStoryDetails('cover story');
		echo $data;
	}

	public function getRankedHOPStory() {
		$data = $this->_newsModel->getRankedStoryDetails('hot of the press');
		echo $data;
	}

	public function updateRankedStories() {
		$data = $this->_newsModel->updateRankedStories($this->rankParams);
		echo $data;
	}

	public function removeRankedStories() {
		$data = $this->_newsModel->deleteRankedStories($this->rankParams);
		echo $data;
	}

	public function searchStory() {
		$data = $this->_newsModel->searchResult($this->order, $this->offset, $this->limit, $this->searchParams);
		echo $data;
	}

	public function getHomepage() {
		$data = $this->_newsModel->getHomePageDetails();
		$news_category = parent::getNewsCategory();
		$menuUrl = array();
		foreach ($news_category as $key => $value) {
			$catUrl[$key] = $this->_commonFunction->sanitizeString($value);
			$menuUrl[$key]['name'] = ucwords(strtolower($value));
			$menuUrl[$key]['url'] = _CONST_WEB_URL . '/' . $catUrl[$key];
		}
		require_once _CONST_VIEW_PATH . 'homepage.tpl.php';
	}

	public function getCategorylistingPage() {
		$news_category = parent::getNewsCategory();
		$menuUrl = array();
		foreach ($news_category as $key => $value) {
			$catUrl[$key] = $this->_commonFunction->sanitizeString($value);
			$menuUrl[$key]['name'] = ucwords(strtolower($value));
			$menuUrl[$key]['url'] = _CONST_WEB_URL . '/' . $catUrl[$key];
		}

		if (in_array($this->category, $catUrl)) {
			$catId = array_search($this->category, $catUrl);
			$this->searchParams['category_id'] = $catId;
			$this->searchParams['publish_status'] = 1;
			$totalCnt = $this->_newsModel->getNewsCount($this->searchParams)['cnt'];
			$totalPages = ceil(($totalCnt / $this->limit) - 1);
			$this->offset = $this->pg * $this->limit;
			$this->pg;
			if ($this->pg > $totalPages) {
				/* redirect to main url of listing page */
			} else {
				$data = $this->_newsModel->getCategoryDetails($this->order, $this->offset, $this->limit, $this->searchParams, 'array');
				$data['news-widget'] = $this->_newsModel->getNewsWidgetDetails();
				$data['background_color_cls'] = 'category-purple-bkgrnd';
				$data['next_url'] = '';
				$data['prev_url'] = '';
				$data['prev_data_url'] = '';
				$data['next_data_url'] = '';
				if ($this->pg == 0) {
					$data['current_url'] = _CONST_WEB_URL . '/' . $this->category;
				} else {
					$data['current_url'] = _CONST_WEB_URL . '/' . $this->category . '/' . $this->pg;
				}

				if ($this->pg > 0 && $this->pg - 1 > 0) {
					$data['prev_url'] = _CONST_WEB_URL . '/' . $this->category . '/' . ($this->pg - 1);
					$data['prev_data_url'] = $data['prev_url'] . '.json';
				} else if ($this->pg > 0 && $this->pg - 1 == 0) {
					$data['prev_url'] = _CONST_WEB_URL . '/' . $this->category;
					$data['prev_data_url'] = $data['prev_url'] . '/0.json';
				}
				if ($this->pg >= 0 && $this->pg + 1 <= $totalPages) {
					$data['next_url'] = _CONST_WEB_URL . '/' . $this->category . '/' . ($this->pg + 1);
					$data['next_data_url'] = $data['next_url'] . '.json';
				}
				$data['categoryName'] = strtoupper($news_category[$catId]);
				require_once _CONST_VIEW_PATH . 'category.tpl.php';
			}
		} else {
		}
	}

	public function getCategorylistingPageJson() {
		$news_category = parent::getNewsCategory();
		foreach ($news_category as $key => $value) {
			$catUrl[$key] = $this->_commonFunction->sanitizeString($value);
		}

		reset($news_category);
		if (in_array($this->category, $catUrl)) {
			$catId = array_search($this->category, $catUrl);
			$this->searchParams['category_id'] = $catId;
			$this->searchParams['publish_status'] = 1;
			$totalCnt = $this->_newsModel->getNewsCount($this->searchParams)['cnt'];
			$totalPages = ceil(($totalCnt / $this->limit) - 1);
			$this->offset = $this->pg * $this->limit;
			$this->pg;
			if ($this->pg > $totalPages) {
				/* redirect to main url of listing page */
			} else {
				$data = $this->_newsModel->getCategoryDetails($this->order, $this->offset, $this->limit, $this->searchParams, 'json');
				$data['next_url'] = '';
				$data['prev_url'] = '';
				$data['prev_data_url'] = '';
				$data['next_data_url'] = '';
				$data['current_url'] = '';
				$menu['menu_url'] = $catUrl;
				if ($this->pg == 0) {
					$data['current_url'] = _CONST_WEB_URL . '/' . $this->category;
				} else {
					$data['current_url'] = _CONST_WEB_URL . '/' . $this->category . '/' . $this->pg;
				}
				if ($this->pg > 0 && $this->pg - 1 > 0) {
					$data['prev_url'] = _CONST_WEB_URL . '/' . $this->category . '/' . ($this->pg - 1);
					$data['prev_data_url'] = $data['prev_url'] . '.json';
				} else if ($this->pg > 0 && $this->pg - 1 == 0) {
					$data['prev_url'] = _CONST_WEB_URL . '/' . $this->category;
					$data['prev_data_url'] = $data['prev_url'] . '/0.json';
				}
				if ($this->pg >= 0 && $this->pg + 1 <= $totalPages) {
					$data['next_url'] = _CONST_WEB_URL . '/' . $this->category . '/' . ($this->pg + 1);
					$data['next_data_url'] = $data['next_url'] . '.json';
				}
				$data['categoryName'] = strtoupper($news_category[$catId]);
				echo json_encode($data);
			}
		} else {
		}
	}

	public function getArticlePage() {
		$news_category = parent::getNewsCategory();
		$menuUrl = array();
		foreach ($news_category as $key => $value) {
			$catUrl[$key] = $this->_commonFunction->sanitizeString($value);
			$menuUrl[$key]['name'] = ucwords(strtolower($value));
			$menuUrl[$key]['url'] = _CONST_WEB_URL . '/' . $catUrl[$key];
		}
		reset($news_category);
		$menuClass = 'bkgrnd_blk';
		$data = $this->_newsModel->getArticleById($this->_autono);
		$data['news-widget'] = $this->_newsModel->getNewsWidgetDetails();
		$data['related-news'] = $this->_newsModel->getRelatedNewsWidgetDetails($data['article-details']['articleId'], $data['article-details']['related_story'], $data['article-details']['news_category']);
		$data['article-details']['category_url'] = $catUrl[$data['article-details']['news_category']];
		$data['article-details']['category_name'] = $news_category[$data['article-details']['news_category']];

		static::$socialTags['og:title'] = $data['article-details']['heading'];
		static::$socialTags['og:type'] = 'article';
		static::$socialTags['og:image'] = _CONST_WEB_URL . $data['article-details']['image_1600'];
		static::$socialTags['og:image:height'] = 900;
		static::$socialTags['og:image:width'] = 1600;
		static::$socialTags['og:url'] = $data['article-details']['news_url'];
		static::$socialTags['og:description'] = $data['article-details']['summary'];
		static::$socialTags['twitter:url'] = $data['article-details']['news_url'];
		static::$socialTags['twitter:title'] = $data['article-details']['heading'];
		static::$socialTags['twitter:description'] = $data['article-details']['summary'];
		static::$socialTags['twitter:image'] = _CONST_WEB_URL . $data['article-details']['image_600'];
		$metaTags['title'] = $data['article-details']['heading'];
		$metaTags['description'] = $data['article-details']['summary'];

		require_once _CONST_VIEW_PATH . 'article.tpl.php';
	}

	public function getSearchPage() {
		$news_category = parent::getNewsCategory();
		$menuUrl = array();
		foreach ($news_category as $key => $value) {
			$catUrl[$key] = $this->_commonFunction->sanitizeString($value);
			$menuUrl[$key]['name'] = ucwords(strtolower($value));
			$menuUrl[$key]['url'] = _CONST_WEB_URL . '/' . $catUrl[$key];
		}
		reset($news_category);
		$menuClass = 'bkgrnd_blk';
		require_once _CONST_VIEW_PATH . 'search.tpl.php';
	}

	public function getLatestNewsPage() {
		$news_category = parent::getNewsCategory();
		$menuUrl = array();
		foreach ($news_category as $key => $value) {
			$catUrl[$key] = $this->_commonFunction->sanitizeString($value);
			$menuUrl[$key]['name'] = ucwords(strtolower($value));
			$menuUrl[$key]['url'] = _CONST_WEB_URL . '/' . $catUrl[$key];
		}
		$this->searchParams['publish_status'] = 1;
		$totalCnt = $this->_newsModel->getNewsCount($this->searchParams)['cnt'];
		$totalPages = ceil(($totalCnt / $this->limit) - 1);
		$this->offset = $this->pg * $this->limit;
		$this->pg;
		if ($this->pg > $totalPages) {
			/* redirect to main url of listing page */
		} else {
			$data['categoryDetails'] = $this->_newsModel->getNewsDetails($this->order, $this->offset, $this->limit, $this->searchParams, 'array');
			$data['news-widget'] = $this->_newsModel->getNewsWidgetDetails();
			$data['background_color_cls'] = 'category-red-bkgrnd';
			$data['next_url'] = '';
			$data['prev_url'] = '';
			$data['prev_data_url'] = '';
			$data['next_data_url'] = '';
			if ($this->pg == 0) {
				$data['current_url'] = _CONST_WEB_URL . '/latest-news';
			} else {
				$data['current_url'] = _CONST_WEB_URL . '/latest-news/' . $this->pg;
			}

			if ($this->pg > 0 && $this->pg - 1 > 0) {
				$data['prev_url'] = _CONST_WEB_URL . '/latest-news/' . ($this->pg - 1);
				$data['prev_data_url'] = $data['prev_url'] . '.json';
			} else if ($this->pg > 0 && $this->pg - 1 == 0) {
				$data['prev_url'] = _CONST_WEB_URL . '/latest-news';
				$data['prev_data_url'] = $data['prev_url'] . '/0.json';
			}
			if ($this->pg >= 0 && $this->pg + 1 <= $totalPages) {
				$data['next_url'] = _CONST_WEB_URL . '/latest-news/' . ($this->pg + 1);
				$data['next_data_url'] = $data['next_url'] . '.json';
			}
			$data['categoryName'] = strtoupper('Latest');
			require_once _CONST_VIEW_PATH . 'category.tpl.php';
		}

	}

	public function getLatestNewsPageJson() {
		$news_category = parent::getNewsCategory();
		foreach ($news_category as $key => $value) {
			$catUrl[$key] = $this->_commonFunction->sanitizeString($value);
		}
		reset($news_category);
		$this->searchParams['publish_status'] = 1;
		$totalCnt = $this->_newsModel->getNewsCount($this->searchParams)['cnt'];
		$totalPages = ceil(($totalCnt / $this->limit) - 1);
		$this->offset = $this->pg * $this->limit;
		$this->pg;
		if ($this->pg > $totalPages) {
			/* redirect to main url of listing page */
		} else {
			$data['categoryDetails'] = $this->_newsModel->getNewsDetails($this->order, $this->offset, $this->limit, $this->searchParams, 'json');
			$data['next_url'] = '';
			$data['prev_url'] = '';
			$data['prev_data_url'] = '';
			$data['next_data_url'] = '';
			$data['current_url'] = '';
			if ($this->pg == 0) {
				$data['current_url'] = _CONST_WEB_URL . '/latest-news';
			} else {
				$data['current_url'] = _CONST_WEB_URL . '/latest-news/' . $this->pg;
			}
			if ($this->pg > 0 && $this->pg - 1 > 0) {
				$data['prev_url'] = _CONST_WEB_URL . '/latest-news/' . ($this->pg - 1);
				$data['prev_data_url'] = $data['prev_url'] . '.json';
			} else if ($this->pg > 0 && $this->pg - 1 == 0) {
				$data['prev_url'] = _CONST_WEB_URL . '/latest-news';
				$data['prev_data_url'] = $data['prev_url'] . '/0.json';
			}
			if ($this->pg >= 0 && $this->pg + 1 <= $totalPages) {
				$data['next_url'] = _CONST_WEB_URL . '/latest-news/' . ($this->pg + 1);
				$data['next_data_url'] = $data['next_url'] . '.json';
			}
			$data['categoryName'] = strtoupper($news_category[$catId]);
			echo json_encode($data);
		}
	}
}
?>
