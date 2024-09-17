<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/inventorynuevo/css/semantic.css">
    <script src="../js/sweetalert2@11.js"></script>
    <script src="../js/jquery-3.7.1.min.js"></script>
</head>
<body>
    
</body>
</html>
<?php

session_start();
if(isset($_SESSION['doc_admin'])){
    echo "<script> window.location='../menu.php';</script>";
}else{

    if(isset($_POST['btn_login'])){
        include '../conexion.php';

        $documento=$_POST['documento'];
        $contraseña=$_POST['contraseña'];
        
        $encrip = md5($contraseña);

        $consultar = mysqli_query($conexion, "SELECT * FROM tbl_administradores WHERE doc_admin = '$documento' and contraseña = '$encrip' and estado='Activo'") or die ("Error en la consulta: " . mysqli_error($conexion));

        $resultado_consulta = mysqli_num_rows($consultar);

        $cambio_contraseña = mysqli_query($conexion, "SELECT * FROM `tbl_administradores` WHERE doc_admin = $documento and cambio_contraseña = 2 and estado='Activo'") or die ("Error en la consulta: " . mysqli_error($conexion));

        $resultado_cambio_contra = mysqli_num_rows($cambio_contraseña);

        if($resultado_consulta != 0){
            while($fila = mysqli_fetch_array($consultar)){

                if($resultado_cambio_contra != 0){
                    $_SESSION['doc_admin'] = $fila['doc_admin'];
                    $_SESSION['primer_n'] = $fila['primer_n'];
                    $_SESSION['segundo_n'] = $fila['segundo_n'];
                    $_SESSION['primer_a'] = $fila['primer_a'];
                    $_SESSION['segundo_a'] = $fila['segundo_a'];
                    $_SESSION['telefono'] = $fila['telefono'];
                    $_SESSION['correo'] = $fila['correo'];
                    $_SESSION['direccion'] = $fila['direccion'];
                    $_SESSION['contraseña'] = $fila['contraseña'];
                    $_SESSION['id_configuracion'] = $fila['id_configuracion'];

                    echo "<script>window.location='recuperar_contraseña/codigo_actualizar_contraseña.php';</script>";
                }else{
                    $_SESSION['doc_admin'] = $fila['doc_admin'];
                    $_SESSION['primer_n'] = $fila['primer_n'];
                    $_SESSION['segundo_n'] = $fila['segundo_n'];
                    $_SESSION['primer_a'] = $fila['primer_a'];
                    $_SESSION['segundo_a'] = $fila['segundo_a'];
                    $_SESSION['telefono'] = $fila['telefono'];
                    $_SESSION['correo'] = $fila['correo'];
                    $_SESSION['direccion'] = $fila['direccion'];
                    $_SESSION['contraseña'] = $fila['contraseña'];
                    $_SESSION['id_configuracion'] = $fila['id_configuracion'];

                    echo "<script>window.location='../menu.php';</script>";
                }
            }
        }else{
            // echo "<script>alert('Usuario y/o contraseña incorrectos');</script>";

            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Usuario y/o contraseña incorrectos',
                    }).then(function() {
                        window.location='login.php';
                    });
                </script>";

            // echo "<script>window.location='login.php';</script>";
        }

    }else{
        echo "<script>window.location='login.php';</script>";
    }
}

?>