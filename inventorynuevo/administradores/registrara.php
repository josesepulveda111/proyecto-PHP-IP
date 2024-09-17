<?php
include "../conexion.php";
    $documento = $_POST['documento'];
    $primer_n = $_POST['primer_n'];
    $segundo_n = $_POST['segundo_n'];
    $primer_a = $_POST['primer_a'];
    $segundo_a = $_POST['segundo_a'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $consulta = "select doc_admin from tbl_administradores where doc_admin='$documento'";
    $resultado = mysqli_query($conexion, $consulta) or die("Fallas en la consulta");
    if ($count = mysqli_num_rows($resultado)) {
        $devolver=1;
    }else{
        $registrar = mysqli_query($conexion, "insert into tbl_administradores (doc_admin, primer_n, segundo_n, primer_a, segundo_a, telefono, correo, direccion, estado) values ('$documento', '$primer_n', '$segundo_n', '$primer_a', '$segundo_a', '$telefono', '$correo', '$direccion', 'Activo')") or die($conexion . "Error al insertar");
        $devolver=2;
    }

echo $devolver;
// echo $devolver;
// mysqli_close($conexion);
?>