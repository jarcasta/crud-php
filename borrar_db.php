
<?php
    require_once "libreria_db.php";
    $id=$_GET['id'];
    $stmt = $pdo->prepare('DELETE FROM persona WHERE id = :id;');
    $stmt->execute(array(':id' => htmlentities($id)));
    header( 'Location: index.php' ) ;
?>