<?php

include_once '../backend/init.php';

if($session->logout() === 'true') {
    redirect_to('login.php');
}
