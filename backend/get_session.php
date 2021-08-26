<?php


require_once 'init.php';

$json = file_get_contents('php://input');
$data = json_decode($json);


echo($session->is_logged_in());
