<?php
require_once 'constants.php';
require_once _CONST_WEB_ROOT_PATH . 'class/AltoRouter.php';

$router = new AltoRouter();
$router->map('GET', '/login', '#list', 'master_CONTROLLER_');
//$router->map('GET', '/master', 'MasterController#list', 'master_CONTROLLER_');
$router->map('GET', '/master/[a:c]/[a:a]?/[i:id]?', '', 'master_CONTROLLER_list');
$router->map('POST', '/master/[a:c]/[a:a]?/[i:id]?', '', 'master_CONTROLLER_operation');

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

?>
