<?php

require_once 'Database.php';

/**
 * Description of Model
 *
 * @author ubuntu
 */
class Model
{
    /**
     *
     * @var PDO $conn
     */
    protected $conn;
    
    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }
}
