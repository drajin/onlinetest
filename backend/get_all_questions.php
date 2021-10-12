<?php

require '../init.php';

echo(json_encode($query->select_all('questions')));