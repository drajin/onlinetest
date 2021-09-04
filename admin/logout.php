<?php

include_once '../backend/init.php';

if($session->logout() === 'true') {
    redirect_to(URLROOT . '/admin/login.php');
}
