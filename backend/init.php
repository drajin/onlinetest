<?php

define('URLROOT', 'http://localhost/onlinetest');


define("PRIVATE_PATH", dirname(__FILE__));
define("INCLUDES_PATH", PRIVATE_PATH . '/../admin/includes');




$config = require('config/config.php');

require 'classes/Connection.php';
require 'classes/QueryBuilder.php';
require 'classes/Admin.php';

$test = 'Ok';

$db = Connection::connect($config['database']);
$session = new Session();
$query = new QueryBuilder($db, $session);
$admin = new Admin();



require 'helpers.php';

//QueryBuilder class
//$db = new QueryBuilder($config['database']);
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

