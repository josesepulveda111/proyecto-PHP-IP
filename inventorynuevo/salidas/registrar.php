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
// Verifica la acción sobre el botón, es decir, si recibió el click
if(isset($_POST['btn_insertar'])){

// Recibimos los valores a enviar
$cantidad=$_POST['cantidadproductos'];
$idproductos=$_POST['idproductos'];
$preciocompra=$_POST['preciocompra'];
$precioventa=$_POST['precioventa'];
$totalSalida=$_POST['totalSalida'];
$rutnit=$_POST['supermercado'];

// Sentencia SQL
$insertarSalida="INSERT INTO tbl_salidas (id_salida, fecha_salida, total_salida, rut_nit_cli) VALUES (NULL, now(), $totalSalida, '$rutnit')";
// Ejecutamos la sentencia
$insertar=mysqli_query($conexion, $insertarSalida) or die ($conexion. "Error al insertar, intente de nuevo!");

// Consultamos la última entrada
$ultimaSalida="SELECT MAX(id_salida) FROM tbl_salidas";
// Ejecutamos la consulta
$consultar=$conexion->query($ultimaSalida);

// Definimos una variable inicial
$ultima=0;

// Recorremos la consulta
while($ultimaF=mysqli_fetch_assoc($consultar)){
    $ultima=$ultimaF['MAX(id_salida)'];
    break;
}


for($a=0; $a<COUNT($cantidad); $a++){
    // Sentencia SQL
    $insertarDetalle="INSERT INTO tbl_productos_salidas (id_salida, cod_producto, cant_pd, precio_compra, precio_venta) VALUES ($ultima, '$idproductos[$a]',$cantidad[$a],$preciocompra[$a],$precioventa[$a])";
    // Ejecutamos la sentencia
    $insertarE=mysqli_query($conexion, $insertarDetalle) or die ($conexion. "Error al insertar, intente de nuevo!");
}

// echo "<script>alert('Entrada registrada con exito!');
//     window.location='../menu.php?mod=registrarentrada';
// </script>";
echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Salida insertada con éxito',
        }).then(function() {
            window.location='../menu.php?mod=consultarsalidas';
            });
    </script>";


// var_dump($cantidad, $idproductos);
//exit();

}

?>