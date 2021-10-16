<?php

namespace app\classes;


class Session {

  //  TODO make $user_id private (used by results as well)
    public string $user_id;
    public string $email;
    public bool $is_admin = false;
    //private string $last_login;


    public function __construct() {
        session_start(); // turn on sessions if needed
        $this->check_stored_login();
    }

    //generate session variables
    public function login($user) {
        if($user) {
            session_regenerate_id();
            $_SESSION['user_id'] = $user->id;
            $this->user_id = $user->id;
            $this->email = $_SESSION['email'] = $user->email; //double assignment to the session and to the property
            //check if the user is admin
            if($user->is_admin) {
                $this->is_admin = $_SESSION['is_admin'] = $user->is_admin;
            }
            //TODO add session max duration
          //  $this->last_login = $_SESSION['last_login'] = time();
            return true;
        } else {
            return false;
        }
    }

    public function  is_logged_in() {
        //isset($this->user_id) ? true : false; TODO ??
        if(isset($this->user_id)) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function is_logged_in_admin() {
        if(isset($this->user_id) && ($this->is_admin)) {
            return true;
        } else {
            return false;
        }
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['email']);
        unset($_SESSION['is_admin']);
        unset($this->user_id);
        unset($this->email);
        unset($this->is_admin);
        return true;
    }

    private function check_stored_login() {
        if(isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->email = $_SESSION['email'];
            if(isset($_SESSION['is_admin'])) {
                $this->is_admin = $_SESSION['is_admin'];
            } else {
                $this->is_admin = false;
            }


        }
    }

    function require_admin_login() {
        if(!$this->is_logged_in_admin()) {
            $this->logout();
            redirect_to(URLROOT . '/admin/login.php');
        } else {
            // Do nothing
        }


    }

    //make static
    function display_session_message() {
        $msg = $this->message();
        if(isset($msg) && $msg != '') {
            $this->clear_message();
            return $msg;
        }
    }


//    public function message($msg='', $type='') {
//        $div_alert = '<div class="alert alert-'.$type.' text-center" role="alert">';
//        $div_alert .= $msg;
//        $div_alert .= '</div>';
//        if(!empty($msg)){
//            $_SESSION['message'] = $div_alert;
//            return true;
//        } else {
//            // this is a get message
//            return $_SESSION['message'] ?? '';
//        }
//    }

    public function message($msg='', $type='') {
        $alert = '<section><div class="row"><div class="col-6 offset-3 mt-3">';
        $alert .= '<div class="alert alert-'.$type.' text-center" role="alert">';
        $alert .= $msg;
        $alert .= '</div></div></div></section>';
        if(!empty($msg)){
            $_SESSION['message'] = $alert;
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