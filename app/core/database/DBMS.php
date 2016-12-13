<?php

namespace app\core\database;

/**
 *
 * @author Tobi
 */
interface DBMS {

    public function connect($param);

    public function disconnect($param);

    public function query($sql);

    public function getAll();

    public function insertID();

    public function numRows($result);
}
