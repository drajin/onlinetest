<?php

define('URLROOT', 'http://localhost/onlinetest');
define("PRIVATE_PATH", dirname(__FILE__));
define("INCLUDES_PATH", PRIVATE_PATH . '/admin/includes');

require_once __DIR__ . '/vendor/autoload.php';

use app\classes\Connection;
use app\classes\QueryBuilder;
use app\classes\Result;
use app\classes\UserController;
use app\classes\Quiz;
use app\classes\Session;



$config = require('config/config.php');

$db = Connection::connect($config['database']);
$session = new Session();

QueryBuilder::set_db_session($db, $session);
$query = new QueryBuilder();
$user_controller = new UserController();
$result = new Result();
$quiz = new Quiz();

require 'helpers.php';




