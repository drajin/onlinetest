<?php

require '../init.php';
use onlinetest\classes\Question;
use onlinetest\classes\Answer;




$response = array(
    'questions' => Question::select_all(),
    'answers'  => Answer::select_all(),
);

echo(json_encode($response));