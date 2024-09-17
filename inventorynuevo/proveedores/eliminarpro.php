<?php
include "../conexion.php";
$rutnit = $_GET['id'];
// $eliminarp="DELETE FROM tbl_proveedores WHERE rut_nit_pv='$rutnit'";
$eliminarp = $conexion->query("UPDATE tbl_proveedores SET estado_pv='Inactivo' WHERE rut_nit_pv='$rutnit'");
mysqli_close($conexion);
?>