<?php

define('URLROOT', 'http://localhost/onlinetest');
define("PRIVATE_PATH", dirname(__FILE__));
define("INCLUDES_PATH", PRIVATE_PATH . '/admin/includes');

require_once __DIR__ . '/vendor/autoload.php';

use onlinetest\classes\Connection;
use onlinetest\classes\QueryBuilder;
use onlinetest\classes\Result;
use onlinetest\classes\User;
use onlinetest\classes\Question;
use onlinetest\classes\Session;



$config = require('config/config.php');

$db = Connection::connect($config['database']);
$session = new Session();

QueryBuilder::set_db_session($db, $session);
$query = new QueryBuilder();
$user_controller = new User();
$result = new Result();
$quiz = new Question();

require 'helpers.php';




