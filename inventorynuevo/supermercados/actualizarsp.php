<html>
<script src="../js/sweetalert2@11.js"></script>
<script src="../js/jquery-3.7.1.min.js"></script>
</html>
<?php
include "../conexion.php";
if (isset($_POST['btn_actualizar'])) {
    $rut_nit_cli = $_POST['rut_nit'];
    $rutnit = $_POST['rutnit'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $consulta = "select * from tbl_supermercados where rut_nit_cli='$rut_nit_cli'";
    $resultado = mysqli_query($conexion, $consulta) or die("Fallas en la consulta");
    if ($count = mysqli_num_rows($resultado) == 0 or $rut_nit_cli == $rutnit) {
        $actualizar = "UPDATE tbl_supermercados SET rut_nit_cli='$rut_nit_cli', nombre_cli='$nombre', direccion_cli='$direccion', correo_cli='$correo', telefono_cli='$telefono', fecha_actualizacion_cli=now() WHERE rut_nit_cli='$rutnit'";
        $ejecutar = mysqli_query($conexion, $actualizar) or die($conexion . "ERROR en el proceso");
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Actualizado correctamente!',
                text: 'Supermercado actualizado',
            }).then(function() {
                window.location.href = '../menu.php?mod=consultarsupermercados';
            });
        </script>";
        // echo "cod ",$cod_producto;
        // echo "<br>";
        // echo $producto, "noexiste";
    } elseif ($count = mysqli_num_rows($resultado) >= 1) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Ya existe este NIT/RUT',
            }).then(function() {
                window.location='../menu.php?mod=actualizarsupermercado&id=$rutnit';
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
