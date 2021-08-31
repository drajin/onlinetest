<?php

define('URLROOT', 'http://localhost/onlinetest');




$config = require('config/config.php');

require 'classes/Connection.php';
require 'classes/QueryBuilder.php';


$db = Connection::connect($config['database']);
$session = new Session();
$query = new QueryBuilder($db, $session);



require 'helpers.php';

//Database class
//$db = new Database($config['database']);
//$db->query('SELECT * FROM users');
//$result = $db->resultSet();
//var_dump($result);




//echo(getPosts($db));
//
//function getPosts($db)
//{
//    $db->query('SELECT * FROM users');
//
//    //returns more then one row
//    return $db->resultSet();
//
//}

