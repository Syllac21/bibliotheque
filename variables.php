<?php

$usersStatement=$mysqlClient->prepare('SELECT * FROM users');
$usersStatement->execute();
$users =$usersStatement->fetchAll();

$booksStatement=$mysqlClient->prepare('SELECT * FROM liste_livres');
$booksStatement->execute();
$books=$booksStatement->fetchAll();

$booksActuality=$mysqlClient->prepare('SELECT * FROM liste_livres ORDER BY date_book DESC LIMIT 3');
$booksActuality->execute();
$booksThree=$booksActuality->fetchAll();
