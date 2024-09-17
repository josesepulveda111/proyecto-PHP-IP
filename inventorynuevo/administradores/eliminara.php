<?php
include "../conexion.php";
$doc_admin = $_GET['id'];
$eliminara = $conexion->query("UPDATE tbl_administradores SET estado='Inactivo' WHERE doc_admin='$doc_admin'");
mysqli_close($conexion);
?>