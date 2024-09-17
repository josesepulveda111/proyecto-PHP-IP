<?php
include "../conexion.php";
$rutnit = $_GET['id'];
$eliminarsp = $conexion->query("UPDATE tbl_supermercados SET estado_cli='Inactivo' WHERE rut_nit_cli='$rutnit'");
mysqli_close($conexion);
?>