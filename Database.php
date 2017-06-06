<?php

/**
 * Description of database
 *
 * @author ubuntu
 */
class Database {

    private $sys;
    private $host;
    private $database;
    private $user;
    private $password;
    
    /**
     *
     * @var PDO 
     */
    private $conn = false;

    /**
     * 
     * @return PDO
     */
    public function __construct() {
        $this->sys = 'mysql';
        $this->host = 'localhost';
        $this->database = 'sala_konferencyjna_db';
        $this->user = 'root';
        $this->password = '';

        if (!$this->conn) {
            try {
                $this->conn = new PDO($this->sys . ':host=' . $this->host . ';dbname=' . $this->database, $this->user, $this->password);                
            } catch (PDOException $e) {
                echo $e->getMessage();
                exit();
            }
        }
    }
    
    /**
     *  Function returns actual connection with database
     * @return PDO
     */
    public function getConnection(){
        return $this->conn;
    }

}
