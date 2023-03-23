<?php
include "includes/conn.php";
include "includes/modal-dismiss.html";
$title = "Eliminando un Cliente";
include "includes/header.php";
if (isset($_POST["client"]))
{
    $id = $_POST["client"];
    $sql = "DELETE FROM client WHERE id=$id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    echo "<script>toast ('0', 'Cliente Eliminado de la Base de Datos', 'El Cliente ha Sido Quitado de la Base de Datos.');</script>";
}
?>