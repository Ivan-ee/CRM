<?php

function tt($str){
    echo "<pre>";
    print_r($str);
    echo "</pre>";
}
function tte($str){
    echo "<pre>";
    print_r($str);
    echo "</pre>";
    exit();
}


const APP_BASE_PATH = 'localhost/CRM';

const DB_HOST = '127.0.0.1';
const DB_USER = 'root';
const DB_PASS = 'root';
const DB_NAME = 'CRM';

const START_ROLE = 1;