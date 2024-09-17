<?php

// include "../conexion.php";

// // $rutProveedor=$_POST['idproveedor'];

// // $rutProveedor=mysqli_real_escape_string($conexion, $rutProveedor);

// $consultaProductos="SELECT * FROM tbl_productos where estado_pd='Activo' and rut_nit_pv=$rutProveedor";
// $resultadoProductos=mysqli_query($conexion, $consultaProductos);

// $respuesta="<option value=''>Seleccione el producto</option>";

// while($consultar=mysqli_fetch_array($resultadoProductos)){

//     $respuesta.="<option data-precioVenta='".$consultar['precio_venta'] ."' data-precioCompra='".$consultar['precio_compra'] ."' data-unidadesMaximas='".$consultar['unidades_maximas']."' value='".$consultar['cod_producto'] ."'>" .$consultar['nombre_pd'] . "</option>";

// }


// echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

include "../conexion.php";

// $rutProveedor=$_POST['idproveedor'];

// $rutProveedor=mysqli_real_escape_string($conexion, $rutProveedor);

$consultaProductos="SELECT * FROM tbl_productos where estado_pd='Activo'";
$resultadoProductos=mysqli_query($conexion, $consultaProductos);

$respuesta="<option value=''>Seleccione el producto</option>";

while($consultar=mysqli_fetch_array($resultadoProductos)){

    $respuesta.="<option data-precioVenta='".$consultar['precio_venta'] ."' data-precioCompra='".$consultar['precio_compra'] ."' data-unidadesExistentes='".$consultar['unidades_existentes']."' value='".$consultar['cod_producto'] ."'>" .$consultar['nombre_pd'] . "</option>";

}


echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

?>