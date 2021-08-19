<?php

define('HOST', 'localhost');
define('DBNAME', 'onlinetest');
define('USER', 'root');
define('PASSWORD', '');



$config = require('config.php');

require 'classes/Connection.php';
require 'classes/QueryBuilder.php';
require 'classes/Database.php';


$db = Connection::connect($config['database']);
$query = new QueryBuilder($db);

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

