<?php
session_start();
require_once 'constants.php';
require_once _CONST_WEB_ROOT_PATH . 'class/AltoRouter.php';
$router = new AltoRouter();
$router->map('GET', '/', 'dashboard#loadDashboard', '');
$router->map('GET', '/login', 'authenticate#showLoginBox', '');
$router->map('GET', '/logout', 'authenticate#logout', '');
$router->map('POST', '/validate', 'authenticate#signin', '');
$router->map('GET', '/master/[a:c]/[a:a]?/[i:id]?', '', 'master_CONTROLLER_list');
$router->map('POST', '/master/[a:c]/[a:a]?/[i:id]?', '', 'master_CONTROLLER_operation');

/** Magazine Backend List ***/
$router->map('GET', '/magazine/users', 'user#getMagazineUsers', '');
$router->map('GET', '/get-magazine-subscriber/list', 'user#getMagazineUsersDetails', '');

$router->map('GET', '/partner', 'partner#getPartners', '');
$router->map('GET', '/get-magazine-partner/list', 'partner#getMagazinePartnerDetails', '');
$router->map('GET', '/partner/add', 'partner#addPartner', '');
$router->map('GET', '/partner/users', 'user#getMagazinePartnerUsers', '');
$router->map('GET', '/get-magazine-partner-subscriber/list', 'user#getMagazinePartnerUsersDetails', '');

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
			break;
	}

	if (!isset($_SESSION['_loggedIn']) && $_GET['route'] != 'validate') {
		$controller_name = 'authenticate';
		$method_name = 'showLoginBox';
	}
	require_once _CONST_CONTROLLER_PATH . $controller_name . '.php';
	$obj = new $controller_name($id, $_POST);
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
