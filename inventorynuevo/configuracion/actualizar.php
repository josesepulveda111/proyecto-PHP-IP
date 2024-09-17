<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/sweetalert2@11.js"></script>
</head>
<body>    
</body>
</html>
<?php
session_start(); 
include "../conexion.php"; 
if (isset($_POST['btn_actualizar'])) {
    $direccion=$_POST['direccion'];
    $primer_n=$_POST['primer_n'];
    $primer_a= $_POST['primer_a'];
    $telefono=$_POST['telefono'];
    $correo=$_POST['correo'];
        
    $doc_admin = $_SESSION['doc_admin'];

    $consulta=mysqli_query($conexion, "UPDATE tbl_administradores SET direccion='$direccion', primer_n='$primer_n', primer_a='$primer_a', telefono='$telefono', correo='$correo' WHERE doc_admin = '$doc_admin'");
        

    // Si la consulta devuelve algo
    if ($consulta){
        $_SESSION['direccion']= $direccion;
        $_SESSION['primer_n']= $primer_n;
        $_SESSION['primer_a']= $primer_a;
        $_SESSION['telefono']= $telefono;
        $_SESSION['correo']=$correo;
            
        echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Datos actualizados!',
                        text: 'Sus datos fueron actualizados correctamente!',
                    }).then(function(){
                        window.location.href = '../menu.php?mod=configuracion';
                    });
                </script>";
        }else{
            echo "Error al actualizar los datos";
        }
    
}
?>