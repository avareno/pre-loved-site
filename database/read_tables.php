<?php
    $db = new PDO('sqlite:database.db'); 

    $stmt = $db->prepare('Select * from products ');
    $stmt->execute();
    $products = $stmt->fetchAll();

    $stmt = $db->prepare('Select * from images ');
    $stmt->execute();
    $images = $stmt->fetchAll();

    $stmt = $db->prepare('SELECT * FROM USERS');
    $stmt->execute();
    $users = $stmt->fetchAll();
?>