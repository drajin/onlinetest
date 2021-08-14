<?php

class Database {



// Radi ali suvise komplikovano...
//    private PDO $dbh;
//
//    private string $error;
//    private $host;
//    private $user;
//    private $pass;
//    private $dbname;
//
//    public function __construct($config)
//    {
//        $this->host = $config['host'] ?? '';
//        $this->dbname = $config['dbname'] ?? '';
//        $this->user = $config['user'] ?? '';
//        $this->pass = $config['pass'] ?? '';
//        //$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->user, $thispass;   //dsn data source name
//
//        // Create PDO instance
//        try{
//            $this->dbh = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->user, $this->pass); //Database Handle
//        } catch(PDOException $e){
//            $this->error = $e->getMessage();
//            echo $this->error;
//        }
//    }
//
//    //stmt = query
//    // Prepare statement with query
//    // Prepare statement with query
//    public function query($sql)
//    {
//        $this->stmt = $this->dbh->prepare($sql);
//    }
//
//    // Bind values
//    public function bind($param, $value, $type = null)
//    {
//        if(is_null($type)){
//            switch(true){
//                case is_int($value):
//                    $type = PDO::PARAM_INT;
//                    break;
//                case is_bool($value):
//                    $type = PDO::PARAM_BOOL;
//                    break;
//                case is_null($value):
//                    $type = PDO::PARAM_NULL;
//                    break;
//                default:
//                    $type = PDO::PARAM_STR;
//            }
//        }
//
//        $this->stmt->bindValue($param, $value, $type);
//    }
//
//    // Execute the prepared statement
//    public function execute()
//    {
//        return $this->stmt->execute();
//    }
//
//    // Get result set as array of objects
//    public function resultSet()
//    {
//        $this->execute();
//        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
//    }
//
//    // Get single record as object
//    public function single()
//    {
//        $this->execute();
//        return $this->stmt->fetch(PDO::FETCH_OBJ);
//    }
//
//    // Get row count
//    public function rowCount(){
//        return $this->stmt->rowCount();
//    }



}