<?php
// $productos = ['Ripio', 'Pandeyuca', 'Galleta cuca', 'Pullpancito', 'Rosquillas'];
// $cantidad = [1, 2, 3, 4, 5];

include "../conexion.php";

// Array para almacenar los datos
$productos = [];
$cantidad= [];

$consulta="SELECT tbl_productos.nombre_pd, SUM(ep.cant_pd) AS total_movimientos
FROM tbl_salidas e
JOIN tbl_productos_salidas ep ON e.id_salida = ep.id_salida
INNER JOIN tbl_productos ON tbl_productos.cod_producto=ep.cod_producto
GROUP BY ep.cod_producto
ORDER BY total_movimientos DESC";

$resultado=mysqli_query($conexion,$consulta) or die ("Fallas en la consulta");

if ($resultado->num_rows>0) {
    while ($row=$resultado->fetch_assoc()) {
        $productos[]=$row['nombre_pd'];
        $cantidad[]=$row['total_movimientos'];
    }
}

// Crear un array asociativo con los datos
$data = [
    'productos' => $productos,
    'cantidad' => $cantidad
];

// Devolver los datos como tipo JSON
echo json_encode($data);
?>