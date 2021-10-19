<?php

include_once '../../init.php';
use onlinetest\classes\Question;
use onlinetest\classes\Answer;


$session->require_admin_login();


$id = $_GET['id'];

//checks if id exists
$question = Question::find_by_id($id);
$answers = Answer::find_all_by_id($id, 'question_id');

if(!$question) {
    redirect_to(URLROOT . '/admin/login.php');
}

Question::delete($id);

foreach($answers as $answer) {
    Answer::delete_by_id($answer->question_id, 'question_id');
}

$session->message('Question deleted', 'success');
redirect_to(URLROOT . '/admin/questions/index.php');








