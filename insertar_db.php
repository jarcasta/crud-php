
<?php
   require_once "libreria_db.php";
   $nombre = $_GET['nombre'];
   $edad = $_GET['edad'];
   $stmt = $pdo->prepare('INSERT INTO persona (nombre, edad) VALUES (:nom, :edad);');
   $stmt->execute(array(
      ':nom' => htmlentities($nombre),
      ':edad' => htmlentities($edad)
   ));
   header('Location: index.php');
?>

