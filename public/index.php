<?php
session_start();

// MENAMPILKAN PESAN ERROR | true OR false |
$error_report = true;
if($error_report === true) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else if($error_report === false) {
    error_reporting(0);
    ini_set('display_errors', 0);
} else {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'The application environment is not set correctly.';
	exit(1);
}

// ZONA WAKTU
date_default_timezone_set('Asia/Jakarta');

require_once '../app/init.php';
$app = new app;