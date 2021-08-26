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
            $_SESSION['user_id'] = $user['id'];
            $this->user_id = $user['id'];
            $this->email = $_SESSION['email'] = $user['email']; //double assignment to the session and to the property
            return 'true';
        } else {
            return 'false';
        }
    }

    public function  is_logged_in() {
        if(isset($this->user_id)) {
            return 'true';
        } else return 'false';
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

    public function message($msg='') {
        if(!empty($msg)){
            // The this is a set message
            $_SESSION['message'] = $msg;
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