<?php

if(basename($_SERVER['PHP_SELF'])=="menu.php"){

include "conexion.php";
$consulta = "select * from tbl_supermercados where estado_cli='Activo' order by fecha_creacion_cli desc";
$resultado = mysqli_query($conexion, $consulta) or die("Fallas en la consulta");
?>
<div class="ui container">
<br>
<h1>Supermercados registrados</h1>
<br>
<table class="ui red table">
                        <thead>
                           <tr>
                              <th>RUT o NIT</th>
                              <th>Nombre</th>
                              <th>Dirección</th>
                              <th>Correo</th>
                              <th>Teléfono</th>
                              <th>Fecha de creación</th>
                              <th>Fecha de actualización</th>
                              <th colspan="2">Acciones</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php while ($columna = mysqli_fetch_array($resultado)) { ?>
                              <tr>
                                 <td><?php echo $columna['rut_nit_cli']; ?></td>
                                 <td><?php echo $columna['nombre_cli']; ?></td>
                                 <td><?php echo $columna['direccion_cli']; ?></td>
                                 <td><?php echo $columna['correo_cli']; ?></td>
                                 <td><?php echo $columna['telefono_cli']; ?></td>
                                 <td><?php echo $columna['fecha_creacion_cli']; ?></td>
                                 <td><?php echo $columna['fecha_actualizacion_cli']; ?></td>
                                 <td><a name="btn_actualizar" href="menu.php?mod=actualizarsupermercado&id=<?php echo $columna['rut_nit_cli']; ?>"><i class="bx bx-edit icon"></i>ACTUALIZAR</a></td>
                                 <td><a name="btn_eliminar" onclick="borrarsp('<?php echo $columna['rut_nit_cli']; ?>')" href="#"><i class="bx bx-trash icon"></i>BORRAR</a></td>
                              </tr>
                           <?php }
                           mysqli_close($conexion)
                              ?>
                        </tbody>
                     </table>
<br>
</div>
<script src="js/sweetalert2@11.js"></script>
<!-- <script src="js/jquery-3.7.1.min.js"></script> -->
<script>
    function borrarsp(codigo) {
    Swal.fire({
        title: "Desea inhabilitar el supermercado?",
        text: "Estara inactivo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        confirmButton: true,
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, seguro",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            mandar_sp(codigo)
        }
    });
}

function mandar_sp(codigo){
    parametros = {id: codigo};
    $.ajax({
        data: parametros,
        url: "Supermercados/eliminar.php",
        type: "GET",
        beforeSend: function () {},
        success: function () {
            Swal.fire("Supermercado inhabilitado", "", "success").then((result)=>{
                window.location.href = "menu.php?mod=consultarsupermercados"
            })
        }
    })
}
</script>

<?php   
}else{
echo "<script>window.location='../menu.php'</script>";
}
?>