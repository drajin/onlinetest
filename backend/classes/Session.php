<?php


class Session {

    private string $user_id;
    public string $email;


    public function __construct() {
        session_start(); // turn on sessions if needed
        $this->check_stored_login();
    }

    public function login($user) {
        if($user) {
            // prevent session fixation attacks
            $_SESSION['user_id'] = $user->id;
            $this->user_id = $user->id;
            $this->email = $_SESSION['email'] = $user->email; //double assignment to the session and to the property
            return true;
        } else {
            return false;
        }
    }

    public function  is_logged_in() {
        //isset($this->user_id) ? true : false; TODO zasto ne radi
        if(isset($this->user_id)) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['email']);
        unset($this->user_id);
        unset($this->email);
        return true;
    }

    private function check_stored_login() {
        if(isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->email = $_SESSION['email'];
        }
    }

    //TODO use
//    function require_login() {
//        if(!$this->is_logged_in()) {
//            redirect_to(URLROOT . '/admin/index.php');
//        } else {
//            // Do nothing
//        }
//
//
//    }


    function display_session_message() {
        $msg = $this->message();
        if(isset($msg) && $msg != '') {
            $this->clear_message();
            return $msg;
        }
    }


        public function message($msg='', $type='') {
        $div_alert = '<div class="alert alert-'.$type.' text-center" role="alert">';
        $div_alert .= $msg;
        $div_alert .= '</div>';
        if(!empty($msg)){
            $_SESSION['message'] = $div_alert;
            return true;
        } else {
            // this is a get message
            return $_SESSION['message'] ?? '';
        }
    }

    public function clear_message() {
        unset($_SESSION['message']);
    }
}


?>