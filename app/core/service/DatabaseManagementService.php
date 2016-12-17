<?php

namespace app\core\service;

use app\core\service\KernelService;

/**
 * Description of DatabaseManagementServise
 *
 * @author Tobi
 */
class DatabaseManagementService extends KernelService {

    public $conn;
    private $connected = false;

    public function __construct() {
        parent::__construct();
        if ($this->connected === false) {
            $this->connect();
        }
    }

    public function connect() {
        $servername = "localhost";
        $username = "root";
        $password = "";

        try {
            $this->conn = new \PDO("mysql:host=$servername;dbname=ntc", $username, $password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connected = true;
            echo "Connected successfully ";
        } catch (\PDOException $e) {
            $this->connected = FALSE;
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function fetch($query) {
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function fetchAllQuery($sql) {
        $q = $this->query($sql);
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetchQuery($sql) {
        $q = $this->query($sql);
        return $q->fetch();
    }

}
