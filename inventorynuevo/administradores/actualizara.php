<?php
include "../conexion.php";
    $doc_admin = $_POST['documento'];
    $doc = $_POST['doc'];
    $primer_n = $_POST['primer_n'];
    $segundo_n = $_POST['segundo_n'];
    $primer_a = $_POST['primer_a'];
    $segundo_a = $_POST['segundo_a'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $consulta = "select * from tbl_administradores where doc_admin='$doc_admin'";
    $resultado = mysqli_query($conexion, $consulta) or die("Fallas en la consulta");
    if (mysqli_num_rows($resultado) == 0 || $doc_admin == $doc) {
        $actualizar = "UPDATE tbl_administradores SET doc_admin='$doc_admin', primer_n='$primer_n',segundo_n='$segundo_n',primer_a='$primer_a',segundo_a='$segundo_a',telefono='$telefono',correo='$correo', direccion='$direccion' WHERE doc_admin='$doc'";
        $ejecutar = mysqli_query($conexion, $actualizar) or die($conexion . "ERROR en el proceso");
        $devolver = 1;
    } else{
        $devolver = 2;
    }

echo $devolver
?>