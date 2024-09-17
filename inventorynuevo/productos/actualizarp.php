<html>
<script src="../js/sweetalert2@11.js"></script>
<script src="../js/jquery-3.7.1.min.js"></script>
</html>
<?php
include "../conexion.php";
if (isset($_POST['btn_actualizar'])) {
    $cod_producto = $_POST['cod_producto'];
    $producto = $_POST['producto'];
    $descrip_pd = $_POST['descrip_pd'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];
    $unidades_maximas = $_POST['unidades_maximas'];
    $unidades_minimas = $_POST['unidades_minimas'];
    $unidades_existentes = $_POST['unidades_existentes'];
    // $fecha_creacion_pd=date("Y/m/d G:i:s");
    // $fecha_actualizacion_pd=date("Y/m/d G:i:s");
    $id_categoria = $_POST['id_categoria'];
    $rut_nit_pv = $_POST['rut_nit_pv'];
    $nombre_pd = $_POST['nombre_pd'];


    $consulta = "select cod_producto from tbl_productos where cod_producto='$cod_producto'";
    $resultado = mysqli_query($conexion, $consulta) or die("Fallas en la consulta");
    if ($count = mysqli_num_rows($resultado) == 0 or $cod_producto == $producto) {
        $actualizar = "UPDATE tbl_productos SET cod_producto='$cod_producto', nombre_pd='$nombre_pd', descrip_pd='$descrip_pd', precio_compra=$precio_compra, precio_venta=$precio_venta, unidades_maximas=$unidades_maximas, unidades_minimas=$unidades_minimas, unidades_existentes=$unidades_existentes, fecha_actualizacion_pd=now(), id_categoria='$id_categoria', rut_nit_pv='$rut_nit_pv' WHERE cod_producto='$producto'";
        $ejecutar = mysqli_query($conexion, $actualizar) or die($conexion . "ERROR en el proceso");
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Actualizado correctamente!',
                text: 'El producto ha sido actualizado',
            }).then(function() {
                window.location.href = '../menu.php?mod=consultarproductos';
            });
        </script>";
        // echo "cod ",$cod_producto;
        // echo "<br>";
        // echo $producto, "noexiste";
    } elseif ($count = mysqli_num_rows($resultado) >= 1) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Ya existe este código',
            }).then(function() {
                window.location='../menu.php?mod=actualizarproducto&id=$producto';
            });
        </script>";
        // echo "<script>window.location='../formactualizar.php?id=$producto';</script>";
        // echo "coddddddddd ",$cod_producto;
        // echo "<br>";
        // echo $producto, " existe";
    }
}
mysqli_close($conexion);
?>