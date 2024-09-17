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
    // Se verifica la acción sobre el botón
    if(isset($_POST['btn_insertar'])){
        // Se reciben los valores
        $cod_producto=$_POST['cod_producto'];
        $nombre_pd=$_POST['nombre_pd'];
        $descrip_pd=$_POST['descrip_pd'];   
        $precio_compra=$_POST['precio_compra'];
        $precio_venta=$_POST['precio_venta'];
        $unidades_maximas=$_POST['unidades_maximas'];
        $unidades_minimas=$_POST['unidades_minimas'];
        $unidades_existentes=$_POST['unidades_existentes'];
        // $fecha_creacion_pd=date("Y/m/d G:i:s");
        // $fecha_actualizacion_pd=date("Y/m/d G:i:s");
        $id_categoria=$_POST['id_categoria'];
        $rut_nit_pv=$_POST['rut_nit_pv'];

        // Sentencia SQL para verificar si un producto ya tiene el código
        $consulta="select cod_producto from tbl_productos where cod_producto='$cod_producto'";
        $resultado=mysqli_query($conexion,$consulta) or die ("Fallas en la consulta");
        if ($count=mysqli_num_rows($resultado)){
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Ya existe este código',
                    }).then(function() {
                        window.location='../menu.php?mod=registrarproducto';
                    });
                </script>";
  
            // echo "<script>window.alert('Ya existe este código');</script>";
            // echo "<script>window.location='../formproductos.php';</script>";
            //echo "<script>'guardarDatos()';</script>";
            //echo "<script>'recuperarDatos()';</script>";

        }else{$registrar=mysqli_query($conexion,"insert into tbl_productos (cod_producto,nombre_pd, descrip_pd, precio_compra, precio_venta, unidades_maximas, unidades_minimas, unidades_existentes, fecha_creacion_pd,fecha_actualizacion_pd,estado_pd, id_categoria, rut_nit_pv) values ('$cod_producto', '$nombre_pd', '$descrip_pd', $precio_compra, $precio_venta, $unidades_maximas, $unidades_minimas, $unidades_existentes,now(), now(), 'Activo',$id_categoria, '$rut_nit_pv')")or die($conexion. "Error al insertar");

            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Producto insertado!',
                        text: 'El producto ha sido insertado correctamente',
                    }).then(function(){
                        window.location.href = '../menu.php?mod=consultarproductos';
                    });
                </script>";
            //echo "<script>window.alert('Producto agregado con éxito');</script>";
            //echo "<script>window.location='../modulacion.php';</script>";
        }   
    }
    mysqli_close($conexion);
?>