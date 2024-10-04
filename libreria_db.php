<?php
    $pdo = new PDO('mysql:host=db;port=3306;dbname=dockerPhp', 'root', 'Password!23');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
