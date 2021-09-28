<?php

include_once '../backend/init.php';

if($session->logout()) {
    redirect_to(URLROOT . '/admin/login.php');
}
