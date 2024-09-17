<html>
<script src="../js/sweetalert2@11.js"></script>
<script src="../js/jquery-3.7.1.min.js"></script>
</html>
<?php
include "../conexion.php";
if(isset($_POST['btn_actualizar'])){
    $rutnit=$_POST['rutnit'];
    $proveedor=$_POST['proveedor'];
    $nombre_pv=$_POST['nombre_pv'];
    $direccion_pv=$_POST['direccion_pv'];   
    $correo_pv=$_POST['correo_pv'];
    $telefono_pv=$_POST['telefono_pv'];


    $consulta="select rut_nit_pv from tbl_proveedores where rut_nit_pv='$rutnit'";
    $resultado=mysqli_query($conexion,$consulta) or die ("Fallas en la consulta");
        if ($count=mysqli_num_rows($resultado)==0 or $rutnit==$proveedor){
            $actualizar="UPDATE tbl_proveedores SET rut_nit_pv='$rutnit', nombre_pv='$nombre_pv', direccion_pv='$direccion_pv', correo_pv='$correo_pv', telefono_pv='$telefono_pv', fecha_actualizacion_pv=now() WHERE rut_nit_pv='$proveedor'";
            $ejecutar=mysqli_query($conexion,$actualizar) or die($conexion."ERROR en el proceso");
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Actualizado correctamente!',
                text: 'El proveedor ha sido actualizado',
            }).then(function() {
                window.location.href = '../menu.php?mod=consultarproveedores';
            });
        </script>";
        }elseif($count=mysqli_num_rows($resultado)>=1){
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Ya existe este RUT/NIT',
            }).then(function() {
                window.location='../menu.php?mod=actualizarproveedor&id=$proveedor';
            });
        </script>";
        }
}
mysqli_close($conexion);
?>