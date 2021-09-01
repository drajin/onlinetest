<?php

include_once '../../backend/init.php';

if($session->is_logged_in() === 'false') {
    redirect_to('login.php');
}








