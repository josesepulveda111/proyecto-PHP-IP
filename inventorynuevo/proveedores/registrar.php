<html>
<script src="../js/sweetalert2@11.js"></script>
<script src="../js/jquery-3.7.1.min.js"></script>
</html>

<?php
include "../conexion.php";
if (isset($_POST['btn_insertar'])) {
    $rutnit = $_POST['rutnit'];
    $nombre_pv = $_POST['nombre_pv'];
    $direccion_pv = $_POST['direccion_pv'];
    $correo_pv = $_POST['correo_pv'];
    $telefono_pv = $_POST['telefono_pv'];
    // $fecha_creacion_pd=date("Y/m/d G:i:s");
    // $fecha_actualizacion_pd=date("Y/m/d G:i:s");
    $consulta = "select rut_nit_pv from tbl_proveedores where rut_nit_pv='$rutnit'";
    $resultado = mysqli_query($conexion, $consulta) or die("Fallas en la consulta");
    if ($count = mysqli_num_rows($resultado)) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Ya existe el proveedor con ese RUT o NIT',
            }).then(function() {
                window.location='../menu.php?mod=registrarproveedor';
            });
        </script>";
    } else {
        $registrar = mysqli_query($conexion, "insert into tbl_proveedores (rut_nit_pv, nombre_pv, direccion_pv, correo_pv, telefono_pv, fecha_creacion_pv, fecha_actualizacion_pv, estado_pv) values ('$rutnit', '$nombre_pv', '$direccion_pv', '$correo_pv', '$telefono_pv',now(), now(), 'Activo')") or die($conexion . "Error al insertar");
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Proveedor insertado!',
                text: 'Se ha insertado correctamente',
            }).then(function() {
                window.location.href = '../menu.php?mod=consultarproveedores';
            });
        </script>";
    }
}
mysqli_close($conexion);
?>