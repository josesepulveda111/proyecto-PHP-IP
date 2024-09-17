<?php
include "../conexion.php";


$id="cod_producto";

// Validación para limpiar la variable por medidas de seguridad
$campo=isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;

$where="";

/* Límite de registros */
$limit=isset($_POST['registros']) ? $conexion->real_escape_string($_POST['registros']) : 10;

$pagina=isset($_POST['pagina']) ? $conexion->real_escape_string($_POST['pagina']) : 0;

if(!$pagina){
    $inicio=0;
    $pagina=1;
}else{
    $inicio=($pagina-1)*$limit;
}

$sLimit="LIMIT $inicio , $limit";


// Esta es la consulta para traer también el nombre del proveedor, SQL_CALC_FOUND_ROWS indica el total de las filas que se están seleccionando
$consulta="SELECT SQL_CALC_FOUND_ROWS tbl_productos.cod_producto, tbl_productos.nombre_pd, tbl_productos.precio_compra, tbl_productos.precio_venta, tbl_productos.unidades_existentes, tbl_productos.id_categoria, tbl_proveedores.nombre_pv FROM tbl_productos INNER JOIN tbl_proveedores ON tbl_proveedores.rut_nit_pv=tbl_productos.rut_nit_pv WHERE tbl_productos.estado_pd='Activo' AND (tbl_productos.cod_producto LIKE '%$campo%' OR tbl_productos.nombre_pd LIKE '%$campo%') ORDER BY tbl_productos.fecha_actualizacion_pd DESC $sLimit";

$resultado = $conexion->query($consulta);
$numrows = $resultado->num_rows;

// Consulta para el total de registros filtrados
$sqlFiltro="SELECT FOUND_ROWS()";
$resFiltro=$conexion->query($sqlFiltro);
$rowFiltro=$resFiltro->fetch_array();
$totalFiltro=$rowFiltro[0];

// Consulta para el total de registros filtrados
$sqlTotal="SELECT COUNT($id) FROM tbl_productos where estado_pd='Activo'";
$resTotal=$conexion->query($sqlTotal);
$rowTotal=$resTotal->fetch_array();
$totalRegistros=$rowTotal[0];

// Vamos a definir un array asociativo, ya que vamos a mandar varios valores (índices) por una promesa (ajax) al consultarproductos.php
$output=[];

// índice de total de registros
$output['totalRegistros']=$totalRegistros;

// índice de total de filtros
$output['totalFiltro']=$totalFiltro;

// índice data, para enviar la tabla
$output['data']='';

// índice de la paginación
$output['paginacion']='';

// Consulta para obtener los nombres de las categorías
$categoriaconsulta="SELECT id_categoria, nombre_ct FROM tbl_categoria_pd WHERE estado_ct='Activo'";
$select=mysqli_query($conexion, $categoriaconsulta);
$categorias=array(); // Almacenamos los resultados en un array, tipo diccionario en python

// Esta es una manera de traer la consulta de categorías
while($categoria=mysqli_fetch_assoc($select)){
    $categorias[$categoria['id_categoria']]=$categoria['nombre_ct'];
}

if($numrows>0){
    while($row=$resultado->fetch_assoc()) {
        // Generamos las columnas fila por fila y las concatenamos con la variable html
        $output['data'].='<tr>';
        $output['data'].='<td>'.$row['cod_producto'].'</td>';
        $output['data'].='<td>'.$row['nombre_pd'].'</td>';
        $output['data'].='<td>'.$row['precio_compra'].'</td>';
        $output['data'].='<td>'.$row['precio_venta'].'</td>';
        $output['data'].='<td>'.$row['unidades_existentes'].'</td>';
        $idcateg=$row['id_categoria'];

        // Buscamos el nombre de la categoría correspondiente al id
        $output['data'].='<td>'.$categorias[$idcateg].'</td>';

        $output['data'].='<td>'.$row['nombre_pv'].'</td>';
        $output['data'].='<td><a name="btn_actualizar" href="menu.php?mod=actualizarproducto&id='.$row['cod_producto'].'"><i class="bx bx-edit"></i><span class="espaciobotones"></span>ACTUALIZAR</a></td>';
        $output['data'].='<td><a name="btn_eliminar" onclick="borrar('.$row['cod_producto'].')" href="#"><i class="bx bx-trash icon"></i>BORRAR</a></td>';
        $output['data'].='</tr>';
    }
} else {
    // $output['data'].='<h4 style="text-align:center;">Sin resultados</h4>';
    $output['data'].='<tr>';
    $output['data'].='<td colspan="8">Sin resultados</td>';
    $output['data'].='</tr>';
}

if($output['totalRegistros']>0){
    $totalPaginas=ceil($output['totalRegistros']/$limit);

    // $output['paginacion'].='<div>';
    $output['paginacion'].='<ul class="ui pagination menu">';

    $numeroInicio=1;

    if(($pagina-4)>1){
        $numeroInicio=$pagina-4;
    }

    $numeroFin=$numeroInicio+9;

    if($numeroFin>$totalPaginas){
        $numeroFin=$totalPaginas;
    }

    for($i=$numeroInicio; $i<=$numeroFin; $i++){
        if($pagina==$i){
            $output['paginacion'].='<li class="item active"><a class="" href="#">'.$i.'</a></li>';
        }else{
        $output['paginacion'].='<li class="item" onclick="getData('.$i.')"><a class="" href="#">'.$i.'</a></li>';
        }
    }

    $output['paginacion'].='</ul>';
    // $output['paginacion'].='</div>';
}


// Esta es la forma más sencilla

// if($numrows>0){
//     while($row=$resultado->fetch_assoc()){
//         // Vamos a generar las columnas, fila por fila (que es lo que devuelve la consulta)
//         // Lo concatenamos con la variable html
//         $html.='<tr>';
//             $html.='<td>'.$row['cod_producto'].'</td>';
//             $html.='<td>'.$row['nombre_pd'].'</td>';
//             $html.='<td>'.$row['precio_compra'].'</td>';
//             $html.='<td>'.$row['precio_venta'].'</td>';
//             $html.='<td>'.$row['unidades_existentes'].'</td>';

//             $idcateg=$row['id_categoria'];

//             $categoriaconsulta="SELECT id_categoria, nombre_ct FROM tbl_categoria_pd where estado_ct='Activo'";
//             $select=mysqli_query($conexion, $categoriaconsulta);

//             while($categoria=mysqli_fetch_array($select)){
//                 if($idcateg==$categoria['id_categoria']){
//                     $html.='<td>'.$categoria['nombre_ct'].'</td>';
//                 }
//             }

//             $html.='<td>'.$row['nombre_pv'].'</td>';
//             $html.='<td><a name="btn_actualizar" href="formactualizar.php?id='.$row['cod_producto'].'"><i class="bx bx-edit"></i><span class="espaciobotones"></span>ACTUALIZAR</a></td>';
//             $html.='<td><a name="btn_eliminar" onclick="borrar('.$row['cod_producto'].')" href="#"><i class="trash alternate icon"></i>BORRAR</a></td>';
//         $html.='</tr>';
//     }
// }else{
//     $html.='<h4 style="text-align:center;" class="texto">Sin resultados</h4>';
// }

echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>
