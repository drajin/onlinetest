<?php

require 'init.php';




$response = array(
    'questions' => $query->select_all('questions_2'),
    'answers'  => $query->select_all('answers')
);


echo(json_encode($response));