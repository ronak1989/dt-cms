<?php
define('_CONST_WEB_ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
define('_CONST_WEB_URL', 'http://' . $_SERVER['SERVER_NAME']);

define('_CONST_MODEL_PATH', $_SERVER['DOCUMENT_ROOT'] . 'model/');
define('_CONST_VIEW_PATH', $_SERVER['DOCUMENT_ROOT'] . 'view/');
define('_CONST_CONTROLLER_PATH', $_SERVER['DOCUMENT_ROOT'] . 'controller/');
define('_CONST_CLASS_PATH', $_SERVER['DOCUMENT_ROOT'] . 'class/');

define('_CONST_CSS_PATH', _CONST_WEB_URL . '/public/css/');
define('_CONST_JS_PATH', _CONST_WEB_URL . '/public/js/');
define('_CONST_IMAGE_URL', _CONST_WEB_URL . '/public/images/');
define('_CONST_FONT_PATH', _CONST_WEB_URL . '/public/fonts/');
define('_CONST_VENDOR_PATH', _CONST_WEB_URL . '/vendor/');
define('_DEBUG', 1);

define('_DB_SERVER_IP', 'ec2-54-169-215-181.ap-southeast-1.compute.amazonaws.com');
define('_DB_SERVER_PORT', '3306');
define('_DB_SERVER_USERNAME', 'dtuser');
define('_DB_SERVER_PASSWORD', 'coldcold');
define('_DB_SERVER_DATABASENAME', 'dalaltimes');
/*define('_DB_SERVER_IP', 'localhost');
define('_DB_SERVER_PORT', '3306');
define('_DB_SERVER_USERNAME', 'root');
define('_DB_SERVER_PASSWORD', 'coldcold');
define('_DB_SERVER_DATABASENAME', 'dalaltimes');
 */?>
