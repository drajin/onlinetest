<?php

namespace onlinetest\classes;
use PDO;

class Connection {
   

    public static function connect($database) 
    {

        try {
            return new PDO('mysql:host=' . $database['host'] . ';dbname=' . $database['dbname'] . ';', $database['user'], $database['password']);  

        } catch(PDOException $e) {
            die("Error ".$e->getMessage());
        }
        
    }

    

}







