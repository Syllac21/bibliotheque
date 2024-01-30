<?php
session_start();
require_once(__DIR__.'/config/mysql.php');
require_once(__DIR__.'/databaseconnect.php');
require_once(__DIR__.'/variables.php');
require_once(__DIR__.'/functions.php');

$postData=$_POST;

// validation des données

if(
    trim(strip_tags($postData['genre']))==='' ||
    trim(strip_tags($postData['titre']))==='' ||
    trim(strip_tags($postData['auteur']))==='' ||
    trim(strip_tags($postData['description']))===''
){
    echo('tous les champs sont obligatoires');
}

$genre=trim(strip_tags($postData['genre']));
$titre=trim(strip_tags($postData['titre']));
$auteur=trim(strip_tags($postData['auteur']));
$description=trim(strip_tags($postData['description']));
$image='test';


$insertBook=$mysqlClient->prepare('INSERT INTO liste_livres(genre, titre, auteur, description, image, proprio) VALUES (:genre, :titre, :auteur, :description, :image, :proprio)');
$insertBook->execute([
    'genre'=>$genre,
    'titre'=>$titre,
    'auteur'=>$auteur,
    'description'=>$description,
    'image'=>$image,
    'proprio'=>$_SESSION['LOGGED_USER']['email'],
]);

header('location: index.php');

