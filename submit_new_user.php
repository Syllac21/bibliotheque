<?php

session_start();

// include
require_once(__DIR__.'/config/mysql.php');
require_once(__DIR__.'/databaseconnect.php');
require_once(__DIR__.'/variables.php');
require_once(__DIR__.'/functions.php');

// vérification des données

$postData = $_POST;

if(
    empty($postData['nom']) ||
    empty($postData['prenom']) ||
    empty($postData['email']) ||
    empty($postData['password']) ||
    !filter_var($postData['email'], FILTER_VALIDATE_EMAIL)
){
    echo 'tous les champs ne sont pas remplis correctement';
    return;
}

// récupération des données

$nom=trim(strip_tags($postData['nom']));
$prenom=trim(strip_tags($postData['prenom']));
$email=trim(strip_tags($postData['email']));
$password=password_hash(trim(strip_tags($postData['password'])), PASSWORD_DEFAULT);

// requête SQL

$insertUser=$mysqlClient ->prepare('INSERT INTO users(nom, prenom, email, password) VALUES (:nom, :prenom, :email, :password)');
$insertUser->execute([
    'nom'=>$nom,
    'prenom'=>$prenom,
    'email'=>$email,
    'password'=>$password,

]);

header("location: index.php");
exit;
?>