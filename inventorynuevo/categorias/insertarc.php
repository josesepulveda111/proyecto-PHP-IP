
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/sweetalert2@11.js"></script>
    <script src="../js/jquery-3.7.1.min.js"></script>
</head>
<body>
    
</body>
</html>
<?php
    include "../conexion.php";
    if(isset($_POST['btn_insertar'])){
        $nombre_ct=$_POST['nombre_ct'];
        $descrip_ct=$_POST['descrip_ct'];
        $consulta="select nombre_ct from tbl_categoria_pd where nombre_ct='$nombre_ct'";
        $resultado=mysqli_query($conexion,$consulta) or die ("Fallas en la consulta");
        if ($count=mysqli_num_rows($resultado)){
            $consulta1="select nombre_ct from tbl_categoria_pd where nombre_ct='$nombre_ct' AND estado_ct='Inactivo'";
            $consulta1=mysqli_query($conexion,$consulta1);
            if($count=mysqli_num_rows($consulta1)>=1){
                // echo "<script>window.alert('¡Hay una categoría inactiva con este nombre!');</script>";
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: '¡Hay una categoría inactiva con este nombre!',
                    }).then(function() {
                        window.location='../menu.php?mod=registrarcategoria';
                    });
                </script>";
            }elseif($count=mysqli_num_rows($consulta1)==0){
                // echo "<script>window.alert('Hay una categoría creada con este nombre!');</script>";
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Hay una categoría creada con este nombre',
                    }).then(function() {
                        window.location='../menu.php?mod=registrarcategoria';
                    });
                </script>";
            }
        }else{
            $insertar="INSERT INTO tbl_categoria_pd (nombre_ct, descrip_ct, estado_ct) VALUES('$nombre_ct','$descrip_ct','Activo')";
            $inserta=mysqli_query($conexion, $insertar) or die($conexion."Error al insertar");
            if($inserta){
            // echo "<script>window.alert('Categoría agregada con éxito!');</script>";
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Categoría insertada!',
                        text: 'Categoría agregada con éxito!',
                    }).then(function(){
                        window.location='../menu.php?mod=registrarcategoria';
                    });
                </script>";
            }
        }   
    }
    mysqli_close($conexion);
     
?>