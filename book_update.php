<?php
session_start();
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');

$getData=$_GET;

if (empty($getData['id']) || !is_numeric($getData['id'])){
    echo('je ne trouve pas le livre');
    return;
}
