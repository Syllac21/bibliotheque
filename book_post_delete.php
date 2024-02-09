<?php
session_start();
require_once(__DIR__.'/isConnect.php');
require_once(__DIR__.'/config/mysql.php');
require_once(__DIR__.'/databaseconnect.php');
require_once(__DIR__.'/functions.php');

$postData=$_POST;
if(
    !is_numeric($postData['id'])||
    empty($postData['id'])
){
    echo'je ne trouve pas le livre';
    return;
}

$id=$postData['id'];

$deleteBookStatement = $mysqlClient -> prepare('DELETE FROM liste_livres WHERE ID_livre=:id');
$deleteBookStatement->execute([
    'id'=>$id,
]);
header("Location: index.php");
return;