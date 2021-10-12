<?php

include_once '../../init.php';


if($session->is_logged_in() === 'false') {
    redirect_to(URLROOT . '/admin/login.php');
}


$id = $_GET['id'];

//checks if id exists
$question = $query->find_by_id($id, 'questions');
$answers = $query->find_all_by_id($id, 'answers', 'question_id');

if($question === false) {
    redirect_to(URLROOT . '/admin/login.php');
}

$query->delete($id, 'questions');

foreach($answers as $answer) {
    $quiz->delete_answers($answer->question_id, 'answers');
}

$session->message('Question deleted', 'success');
redirect_to(URLROOT . '/admin/questions/index.php');








