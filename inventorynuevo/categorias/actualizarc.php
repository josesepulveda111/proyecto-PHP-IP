

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/sweetalert2@11.js"></script>
    <!-- <script src="../js/jquery-3.7.1.min.js"></script> -->
</head>
<body>
    
</body>
</html>
<?php
include "../conexion.php";
if(isset($_POST['btn_actualizar'])){
    $nombre_ct=$_POST['nombre_ct'];
    $nombre=$_POST['nombre'];
    $descrip_ct=$_POST['descrip_ct'];
    $id_categoria=$_POST['id_categoria'];
    $consulta="select nombre_ct from tbl_categoria_pd where nombre_ct='$nombre_ct'";
    $resultado=mysqli_query($conexion,$consulta) or die ("Fallas en la consulta");
        if ($count=mysqli_num_rows($resultado)==0 or $nombre_ct==$nombre){
            $actualizar="UPDATE tbl_categoria_pd SET nombre_ct='$nombre_ct', descrip_ct='$descrip_ct' WHERE id_categoria='$id_categoria'";
            $ejecutar=mysqli_query($conexion,$actualizar) or die($conexion."ERROR en el proceso");
            // echo "<script>window.alert('ACTUALIZADO CORRECTAMENTE');</script>";
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Categoría actualizada correctamente!'
                    }).then(function(){
                        window.location='../menu.php?mod=registrarcategoria';
                    });
                </script>";
            
            
        }elseif($count=mysqli_num_rows($resultado)>=1){
            // echo "<script>window.alert('Ya existe una categoría con este nombre');</script>";
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Ya existe una categoría con este nombre',
                    }).then(function() {
                        window.location='../menu.php?mod=actualizarcategoria&id=$id_categoria';
                    });
                </script>";
        }
}
mysqli_close($conexion);

?>