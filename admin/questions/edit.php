<?php

include_once '../../init.php';
use onlinetest\classes\Question;

//checks if question is logged in
$session->require_admin_login();

$id = $_GET['id'];

$question = Question::find_by_id($id);

if(!$question) {
    $session->message('Something went wrong.', 'danger');
    redirect_to(URLROOT . '/admin/questions/index.php');
}

$answers = $quiz->find_by_question_id($id, 'answers');

//$question_data = ($admin->validate_question());

//if (empty($question_data['question_text_error']) && empty($question_data['answer_1_error']) && empty($question_data['answer_2_error'])
//    && empty($question_data['answer_3_error']) && empty($question_data['answer_4_error']) && empty($question_data['correct_answer_error']) && empty($question_data['points_error'])
//    && !empty($question_data['question_text']) && !empty($question_data['answer_1']) && !empty($question_data['answer_2'])) {
//   if($query->update_question($question_data, $id)) {
//        $session->message('Quiz updated successfully', 'success');
//        redirect_to(URLROOT .'/admin/questions/index.php');
//    } else {
//        $session->message('Something went wrong.', 'danger');
//        redirect_to(URLROOT .'/admin/questions/index.php');
//    }
//} else {
//    $errors = $question_data;
//}

include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');

include 'views/edit.view.php';

include(INCLUDES_PATH . '/footer.php');

