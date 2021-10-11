<?php

require 'init.php';




$response = array(
    'questions' => $query->select_all('questions'),
    'answers'  => $query->select_all('answers')
);

echo(json_encode($response));