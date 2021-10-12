<?php

    require_once('../init.php');

    echo json_encode($query->select_all('users'));