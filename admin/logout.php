<?php

include_once '../init.php';

if($session->logout()) {
    redirect_to(URLROOT . '/admin/login.php');
}
