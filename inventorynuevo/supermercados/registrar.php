<html>
<script src="../js/sweetalert2@11.js"></script>
<script src="../js/jquery-3.7.1.min.js"></script>

</html>
<?php
include "../conexion.php";
if (isset($_POST['guardar_super'])) {
    $rut_nit = $_POST['rut_nit'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $consulta = "select rut_nit_cli from tbl_supermercados where rut_nit_cli='$rut_nit'";
    $resultado = mysqli_query($conexion, $consulta) or die("Fallas en la consulta");
    if ($count = mysqli_num_rows($resultado)) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Ya existe el supermercado',
            }).then(function() {
                window.location='../menu.php?mod=registrarsupermercado';
            });
        </script>";
    } else {
        $registrar = mysqli_query($conexion, "insert into tbl_supermercados (rut_nit_cli,nombre_cli, direccion_cli, correo_cli, telefono_cli, fecha_creacion_cli, fecha_actualizacion_cli, estado_cli) values ('$rut_nit', '$nombre', '$direccion', '$correo', '$telefono', now(), now(), 'Activo')") or die($conexion . "Error al insertar");
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Supermercado insertado!',
                text: 'Se ha sido insertado correctamente',
            }).then(function() {
                window.location.href = '../menu.php?mod=consultarsupermercados';
            });
        </script>";
    }
}
mysqli_close($conexion);
?>