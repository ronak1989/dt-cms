<?php
require_once '../constants.php';

// Ensure reporting is setup correctly
mysqli_report(MYSQLI_REPORT_STRICT);

/*class Database {
private $host = _DB_SERVER_IP;
private $user = _DB_SERVER_USERNAME;
private $pass = _DB_SERVER_PASSWORD;
private $dbname = _DB_SERVER_DATABASENAME;

private $dbh;
private $error;
private $stmt;

public function __construct() {
// Set DSN
$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
// Set options
$options = array(
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
);
// Create a new PDO instanace
try {
$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
}
// Catch any errors
catch (PDOException $e) {
$this->error = $e->getMessage();
}
}

public function query($query) {
$this->stmt = $this->dbh->prepare($query);
}

public function bind($param, $value, $type = null) {
if (is_null($type)) {
switch (true) {
case is_int($value):
$type = PDO::PARAM_INT;
break;
case is_bool($value):
$type = PDO::PARAM_BOOL;
break;
case is_null($value):
$type = PDO::PARAM_NULL;
break;
default:
$type = PDO::PARAM_STR;
}
}
$this->stmt->bindValue($param, $value, $type);
}

public function execute() {
return $this->stmt->execute();
}

public function resultset() {
$this->execute();
return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function single() {
$this->execute();
return $this->stmt->fetch(PDO::FETCH_ASSOC);
}

public function rowCount() {
return $this->stmt->rowCount();
}

public function lastInsertId() {
return $this->dbh->lastInsertId();
}

public function beginTransaction() {
return $this->dbh->beginTransaction();
}

public function endTransaction() {
return $this->dbh->commit();
}

public function cancelTransaction() {
return $this->dbh->rollBack();
}

public function debugDumpParams() {
return $this->stmt->debugDumpParams();
}
}*/

class Database {

	protected static $instance;
	private $_mysqli;
	private $_query;
	private static $_results = array();
	private $_count = 0;
	private $_affected_rows = 0;
	private $_last_insert_id = null;

	public static function getInstance() {
		if (!isset(self::$instance)) {
			echo "444";
			self::$instance = new Database();
		}
		return self::$instance;
	}

	private function __construct() {
		try {
			$this->_mysqli = new mysqli(_DB_SERVER_IP, _DB_SERVER_USERNAME, _DB_SERVER_PASSWORD, _DB_SERVER_DATABASENAME, _DB_SERVER_PORT);
			echo "333";
		} catch (mysqli_sql_exception $e) {
			echo 'error connecting db';
		}
	}

	public function query($sql, $type = 'select') {
		try {
			$this->_query = $this->_mysqli->query($sql);
			switch ($type) {
				case 'insert':
					$this->_last_insert_id = $this->_query->insert_id;
				case 'update':
				case 'delete':
					$this->_affected_rows = $this->_query->affected_rows;
					break;
				case 'select':
					while ($row = $this->_query->fetch_object()) {
						$this->_results[] = $row;
					}
					$this->_count = $this->_query->num_rows;
					break;
			}
			return $this;
		} catch (mysqli_sql_exception $e) {
			echo 'error in executeSelectQuery';
		}
	}

	public function getResult() {
		return $this->_results;
	}

	public function getNumRows() {
		return $this->_count;
	}

	public function getAffectedRows() {
		return $this->_affected_rows;
	}

	public function getLastInsertId() {
		return $this->_last_insert_id;
	}

	public function __destruct() {
		foreach (array_keys(get_object_vars($this)) as $key => $value) {
			unset($this->$value);
		};
	}
}

$instance = Database::getInstance() /*->query('SELECT * FROM cms_users')*/;
print_r($instance);

?>
