<?php
    include "../conexion.php";
    $cod_producto=$_GET['id'];
    // $eliminarp="DELETE FROM tbl_productos WHERE cod_producto='$cod_producto'";
    $eliminarp="UPDATE tbl_productos SET estado_pd='Inactivo' WHERE cod_producto='$cod_producto'";
    $eliminar=mysqli_query($conexion,$eliminarp);
    // if($eliminar){
    //     echo "<script>window.location='../menu.php?mod=consultarproductossss';</script>";
    // }
    mysqli_close($conexion);
?>