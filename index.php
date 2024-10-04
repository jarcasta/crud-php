<!DOCTYPE html>

<html>
<head>
   <title>Tarea 1 CRUD PHP</title>
   <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
   <h1>Ejercicio de PHP con acceso a base de datos MySql</h1>

   <?php
   include("libreria_db.php");

   $id = '';
   $nombre = '';
   $edad = '';
   $accion = 'Grabar'; 
   $boton = 'Grabar';  


   if (isset($_GET['id']) && isset($_GET['nombre']) && isset($_GET['edad'])) {
       $id = $_GET['id'];
       $nombre = $_GET['nombre'];
       $edad = $_GET['edad'];
       $accion = 'Actualizar'; 
       $boton = 'Actualizar';  
   }
   ?>

   <!-- Formulario para insertar o editar -->
   <form action="index.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <table>
         <tr>
            <td>ID:</td>
            <td><input type="text" name="id_disabled" value="<?php echo $id; ?>" disabled></td>
         </tr>
         <tr>
            <td>Nombre:</td>
            <td><input type="text" name="nombre" value="<?php echo $nombre; ?>"  maxlength="50"></td>
         </tr>
         <tr>
            <td>Edad:</td>
            <td><input type="text" name="edad" value="<?php echo $edad; ?>" maxlength="3"></td>
         </tr>
      </table>
      <input type="submit" name="accion" value="<?php echo $boton; ?>">
      <?php if ($accion == 'Actualizar'): ?>
          <button type="button" onclick="window.location.href='index.php';">Cancelar</button>
      <?php endif; ?>
   </form>

   <hr>

   <?php

   if (isset($_POST['accion'])) {
       $nombre = $_POST['nombre'];
       $edad = $_POST['edad'];

       if ($_POST['accion'] == 'Actualizar') {
      
           $id = $_POST['id'];
           $stmt = $pdo->prepare('UPDATE persona SET nombre = :nombre, edad = :edad WHERE id = :id');
           $stmt->execute(array(':nombre' => $nombre, ':edad' => $edad, ':id' => $id));
       } else {
 
           $stmt = $pdo->prepare('INSERT INTO persona (nombre, edad) VALUES (:nombre, :edad)');
           $stmt->execute(array(':nombre' => $nombre, ':edad' => $edad));
       }


       header('Location: index.php');
       exit;
   }


   $stmt = $pdo->query("SELECT id, nombre, edad FROM persona");
   ?>
   <table border="1" cellspacing="1" cellpadding="1">
      <tr>
         <td>&nbsp;<b>ID</b>&nbsp;</td>
         <td>&nbsp;<b>Nombre</b>&nbsp;</td>
         <td>&nbsp;<b>Edad</b>&nbsp;</td>
         <td>&nbsp;<b>Acciones</b>&nbsp;</td>
      </tr>
      <?php
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>";
          echo "<td>&nbsp;" . $row['id'] . "&nbsp;</td>";
          echo "<td>&nbsp;" . $row['nombre'] . "&nbsp;</td>";
          echo "<td>&nbsp;" . $row['edad'] . "&nbsp;</td>";
          echo "<td>&nbsp;<a href='editar_db.php?id=" . $row['id'] . "'>Editar</a>&nbsp;|&nbsp;<a href='borrar_db.php?id=" . $row['id'] . "'>Eliminar</a>&nbsp;</td>";
          echo "</tr>";
      }
      ?>
   </table>

</body>
</html>