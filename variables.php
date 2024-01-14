<?php

$usersStatement=$mysqlClient->prepare('SELECT * FROM users');
$usersStatement->execute();
$users =$usersStatement->fetchAll();

?>