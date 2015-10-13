<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
require_once 'constants.php';
require_once _CONST_WEB_ROOT_PATH . 'class/AltoRouter.php';
$router = new AltoRouter();
$router->map('GET', '/', 'dashboard#loadDashboard', '');
$router->map('GET', '/login', 'authenticate#showLoginBox', '');
$router->map('GET', '/logout', 'authenticate#logout', '');
$router->map('POST', '/reset-password', 'authenticate#forgotPassword', '');
$router->map('GET', '/change-password', 'authenticate#changePassword', '');
$router->map('POST', '/revise-password', 'authenticate#revisePassword', '');
$router->map('POST', '/validate', 'authenticate#signin', '');
$router->map('GET', '/master/[a:c]/[a:a]?/[i:id]?', '', 'master_CONTROLLER_list');
$router->map('POST', '/master/[a:c]/[a:a]?/[i:id]?', '', 'master_CONTROLLER_operation');

/** Magazine Backend List ***/
$router->map('GET', '/create/user', 'user#getUserForm', '');
$router->map('GET', '/magazine/users', 'user#getMagazineUsers', '');
$router->map('GET', '/get-magazine-subscriber/list', 'user#getMagazineUsersDetails', '');

$router->map('GET', '/partner', 'partner#getPartners', '');
$router->map('GET', '/get-magazine-partner/list', 'partner#getMagazinePartnerDetails', '');
$router->map('GET', '/partner/add', 'partner#addPartner', '');
$router->map('GET', '/partner/users', 'user#getMagazinePartnerUsers', '');
$router->map('GET', '/get-magazine-partner-subscriber/list', 'user#getMagazinePartnerUsersDetails', '');

$router->map('POST', '/api/input-validate/', 'validation#checkInput', '');

/**** EDITOR ****/
$router->map('GET|POST', '/news/editor/compose/?[i:id]?', 'editor#compose', '');
$router->map('GET|POST', '/news/editor/savearticle', 'editor#savearticle', '');
$router->map('POST', '/news/editor/loadsubcategories', 'editor#loadsubcategories', '');
$router->map('GET|POST|PATCH|PUT|DELETE', '/news/upload_attachment', 'editor#uploadAttachment', '');
$router->map('GET|POST', '/news/search/story', 'news#searchStory', '');
/** News **/
$router->map('GET', '/news/latest', 'news#getNews', '');
$router->map('GET', '/news/latest/list', 'news#getLatestNews', '');

/** Image **/
$router->map('GET', '/news/image/new', 'image#getImageUploadList', '');
$router->map('GET|POST', '/news/image/upload', 'image#uploadNewImage', '');

/** Ranking **/
$router->map('GET', '/rank/cover-story/', 'news#getCoverStoryPage', '');
$router->map('GET', '/rank/hot-of-the-press/', 'news#getHOPpage', '');
$router->map('GET', '/ranked/cover-story/news/', 'news#getRankedCoverStory', '');
$router->map('GET', '/ranked/hot-of-the-press/news/', 'news#getRankedHOPStory', '');
$router->map('POST', '/rank/update/', 'news#updateRankedStories', '');
$router->map('POST', '/rank/remove/', 'news#removeRankedStories', '');

$controller_name = null;
$method_name = null;
$id = null;
$match = $router->match();
if ($match) {
	switch (trim($match['target'])) {
		case '':
			$controller_name = $match['params']['c'];
			$method_name = $match['params']['a'];
			if (!empty($match['params']['id'])) {
				$id = $match['params']['id'];
			}
			break;
		default:
			$class_params = explode("#", $match['target']);
			$controller_name = $class_params[0];
			$method_name = $class_params[1];
			if (!empty($match['params']['id'])) {
				$id = $match['params']['id'];
			}
			break;
	}

	if (!isset($_SESSION['_loggedIn']) && $_GET['route'] != 'validate' && $_GET['route'] != 'reset-password') {
		$controller_name = 'authenticate';
		$method_name = 'showLoginBox';
	}

	require_once _CONST_CONTROLLER_PATH . $controller_name . '.php';
	$obj = new $controller_name($id, $_REQUEST);
	if ($method_name == 'list') {
		$method_name = "details";
	}

	$obj->$method_name();
} else {
	/**
	 * Return 404 Header
	 *
	 */
	// no route was matched
	//header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
session_write_close();
?>
