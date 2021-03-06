<?php

namespace app\core\service;

/**
 * Description of DatabaseManagementServise
 *
 * @author Tobi
 */
class DatabaseManagementService extends KernelService
{

    public $conn;
    private $connected = false;

    public function __construct()
    {
        parent::__construct();
        if ($this->connected === false) {
            $this->connect();
        }
    }

    public function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";

        try {
            $this->conn = new \PDO("mysql:host=$servername;dbname=eloquent", $username, $password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connected = true;
            $this->log("Connected successfully to database");
        } catch (\PDOException $e) {
            $this->connected = FALSE;
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function fetch($query)
    {
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function fetchAllQuery($sql)
    {
        $q = $this->query($sql);
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function query($sql)
    {
        return $this->conn->query($sql);
    }

    public function fetchQuery($sql)
    {
        $q = $this->query($sql);
        return $q->fetch(\PDO::FETCH_ASSOC);
    }

}
