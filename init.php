<?php

define('URLROOT', 'http://localhost/onlinetest');
define("PRIVATE_PATH", dirname(__FILE__));
define("INCLUDES_PATH", PRIVATE_PATH . '/admin/includes');

require_once __DIR__ . '/vendor/autoload.php';

use app\classes\Connection;
use app\classes\QueryBuilder;
use app\classes\Admin;
use app\classes\Result;
use app\classes\UserController;
use app\classes\Quiz;
use app\classes\Session;



$config = require('config/config.php');

//require 'classes/Connection.php';
////require 'classes/QueryBuilder.php';
//require 'classes/Admin.php';
//require 'classes/Result.php';
//require 'classes/UserController.php';
//require 'classes/Quiz.php';

$test = 'Ok';

$db = Connection::connect($config['database']);
$session = new Session();

QueryBuilder::set_db_session($db, $session);
$query = new QueryBuilder();
$user_controller = new UserController();
$admin = new Admin();
$result = new Result();
$quiz = new Quiz();

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

