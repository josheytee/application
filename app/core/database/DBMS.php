<?php

use app\core\service\KernelService;

/**
 * Description of DatabaseManagementServise
 *
 * @author Tobi
 */
class DatabaseManagementService extends KernelService {

    private $conn;

    public function __construct() {
        parent::__construct();
        $this->connect();
    }

    public function start() {
        return parent::start();
    }

    public function connect() {
        $servername = "localhost";
        $username = "root";
        $password = "";

// Create connection
        $this->conn = new \mysqli($servername, $username, $password);

// Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $this->log("Connected successfully");
        $this->conn->select_db('ntc');
    }

    public function getConnection() {
        return $this->conn;
    }

    public function disconnect() {
        return $this->conn->close();
    }

    public function getAll() {

    }

    public function insertID() {
        return $this->conn->insert_id;
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function numRows($result) {
        return $result->num_rows;
    }

    public function subscribe() {
        parent::subscribe();
        return $this;
    }

    public function unsubscribe() {
        parent::unsubscribe();
        return$this->disconnect();
    }

}
