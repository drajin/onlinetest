<?php

require '../init.php';
use app\classes\Question;
use app\classes\Answer;




$response = array(
    'questions' => Question::select_all(),
    'answers'  => Answer::select_all(),
);

echo(json_encode($response));