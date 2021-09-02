<?php

function redirect_to($location) {
    header("Location: " . $location);
    exit;
}


function display_time($time) {
    if($time) {
        echo date('d.m.Y H:i', strtotime($time));
    } else {
        return false;
    }

}

