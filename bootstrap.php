<?php

// Adjust paths as needed
const PATH = 'C:/xampp/htdocs/phpprojekt/';
const BASE_URL = 'http://melihayildiz.com/phpprojekt/';

const LIB_PATH = PATH.'lib/';
require_once LIB_PATH.'authentication.php';
require_once LIB_PATH.'database.php';
require_once LIB_PATH.'request.php';
require_once LIB_PATH.'response.php';
require_once LIB_PATH.'session.php';
require_once LIB_PATH.'view.php';

// Don't forget to adjust the DB connection details
$database = db_connect([
    'host' => '92.205.00.000',
    'username' => 'meliha',
    'password' => 'asdf',
    'database' => 'yoga'
]);

session_start();

$errors = [];

$active_page = $active_page ?? ''; // For the <nav>
