<?php
if (!defined("DB_DSN")) define("DB_DSN", "mysql:host=localhost; dbname=hoteldb");
if (!defined("DB_URL")) define("DB_URL", "mysql://localhost:3306/hoteldb");
if (!defined("DB_USER")) define("DB_USER", "hoteldb_admin");
if (!defined("DB_PASSWORD")) define("DB_PASSWORD", "admin123");

function connectDatabase():PDO {
	
	$pdo = null;
	try {
	
		$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'");
		$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD, $options);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo $e->getMessage();
	} finally {
		return $pdo;
	}
}

function disconnectDatabase(PDO $pdo):void {
	if (!is_null($pdo)) {
		unset($pdo);
	}
}

?>