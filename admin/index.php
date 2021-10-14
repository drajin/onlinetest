<?php
//TODO .htaccess
include_once '../init.php';

$session->require_admin_login();


include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');


//foreach($questions as $question) {
//    echo $question->question_text . '<br>';
//    echo ('<ul>');
//    foreach($answers as $answer) {
//        if($question->id === $answer->question_id) {
//            echo '<li>' . $answer->answer_text . '</li><br>';
//        }
//    }
//    echo ('</ul>');
//
//}

//foreach($answers as $answer) {
//    echo $answer->answer_text . '<br>';
//}

//echo '<pre>';
//var_dump($count);
//echo '</pre>';


include 'views/index.view.php';



include(INCLUDES_PATH . '/footer.php');