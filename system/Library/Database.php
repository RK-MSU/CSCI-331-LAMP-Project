<?php

namespace Lamp\Library;

class Database
{
    protected $db_info;
    protected $conn;
    
    public function __construct()
    {
        global $config;
        
        $this->db_info = $config['database'];
    }
    
    public function getConnection()
    {
        if (isset($this->conn)) {
            return $this->conn;
        }
        
        $dbhost  = $this->db_info['host'];
        $dbname  = $this->db_info['database'];
        $dbuser  = $this->db_info['username'];
        $dbpass  = $this->db_info['password'];
        
        // Create connection
        // $this->conn = new \mysqli($dbhost, $dbuser, $dbpass, $dbname);
        $this->conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        
        
        // Check connection
        if ($this->conn->connect_error) {
            die("DB Connection failed: " . $this->conn->connect_error);
        }
        
        return $this->conn;
    }
    
    
    public function getLastInsertId()
    {
        return mysqli_insert_id($this->getConnection());
    }
    
    
    public function query($query_str)
    {
        $conn = $this->getConnection();
        
        $result = $conn->query($query_str);
        
//         $result->
        
        if (!$result) {
            die("DB Query Error");
        }
        
        return $result;
    }
}
