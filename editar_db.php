<?php
require_once "libreria_db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare('SELECT * FROM persona WHERE id = :id');
    $stmt->execute(array(':id' => $id));
    $persona = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($persona) {
        header("Location: index.php?id={$persona['id']}&nombre={$persona['nombre']}&edad={$persona['edad']}");
        exit;
    } else {
        echo "Registro no encontrado.";
        exit;
    }
} else {
    echo "ID no especificado.";
    exit;
}