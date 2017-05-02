<?php

class Database {

	private $hostname = "localhost";
	private $username = "root";
	private $password = "";
	private $bd_name = "oms";
	public $conn;

	public function __construct(){
		if (!isset($this->conn)) {
			try {
				$sql = new PDO("mysql:host=" . $this->hostname . ";dbname=" . $this->bd_name, $this->username, $this->password);
				$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql->exec("SET CHARACTER SET utf8");
				$this->conn = $sql;
			} catch (PDOException $e) {
				die("Faied to connection with Database!".$e->getMessage());
			}
		}
	}

}

?>