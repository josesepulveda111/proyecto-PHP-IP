
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
$totalEntrada=$_POST['totalEntrada'];

// Sentencia SQL
$insertarEntrada="INSERT INTO tbl_entradas (id_entrada, fecha_entrada, total_entrada) VALUES (NULL, now(), $totalEntrada)";
// Ejecutamos la sentencia
$insertar=mysqli_query($conexion, $insertarEntrada) or die ($conexion. "Error al insertar, intente de nuevo!");

// Consultamos la última entrada
$ultimaEntrada="SELECT MAX(id_entrada) FROM tbl_entradas";
// Ejecutamos la consulta
$consultar=$conexion->query($ultimaEntrada);

// Definimos una variable inicial
$ultima=0;

// Recorremos la consulta
while($ultimaF=mysqli_fetch_assoc($consultar)){
    $ultima=$ultimaF['MAX(id_entrada)'];
    break;
}


for($a=0; $a<COUNT($cantidad); $a++){
    // Sentencia SQL
    $insertarDetalle="INSERT INTO tbl_entradas_productos (id_entrada, cod_producto, cant_pd, precio_compra, precio_venta) VALUES ($ultima, '$idproductos[$a]',$cantidad[$a],$preciocompra[$a],$precioventa[$a])";
    // Ejecutamos la sentencia
    $insertarE=mysqli_query($conexion, $insertarDetalle) or die ($conexion. "Error al insertar, intente de nuevo!");
}

// echo "<script>alert('Entrada registrada con exito!');
//     window.location='../menu.php?mod=registrarentrada';
// </script>";
echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Entrada insertada con éxito',
        }).then(function() {
            window.location='../menu.php?mod=consultarentradas';
            });
    </script>";


// var_dump($cantidad, $idproductos);
//exit();

}

?>