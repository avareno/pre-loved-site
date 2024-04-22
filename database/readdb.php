<?php
    $db = new PDO('sqlite:database.db'); 

    $stmt = $db->prepare('Select * from products ');
    $stmt->execute();
    $products = $stmt->fetchAll();
?>