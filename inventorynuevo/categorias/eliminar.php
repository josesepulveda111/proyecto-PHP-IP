<?php
    include "../conexion.php";
    $id_categoria=$_GET['id'];
    $eliminarc="UPDATE tbl_categoria_pd set estado_ct='Inactivo' WHERE id_categoria='$id_categoria'";
    $eliminar=mysqli_query($conexion,$eliminarc) or die($conexion. "Error al eliminar. Comuníquese con el admin.");
    // if($eliminar){
    //     echo "<script>window.location='../menu.php?mod=registrarcategoria';</script>";
    // }
    mysqli_close($conexion);
?>