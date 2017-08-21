<?php

namespace app\core\database;

use app\core\database\DBMS;

/**
 * Description of Db
 *
 * @author Tobi
 */
class Db implements DBMS {

    private $conn;

    public function connect() {
        $servername = "localhost";
        $username = "root";
        $password = "";

// Create connection
        $this->conn = new mysqli($servername, $username, $password);

// Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";
    }

    public function disconnect($param) {
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

}
