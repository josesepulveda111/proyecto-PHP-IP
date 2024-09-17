<?php

if(basename($_SERVER['PHP_SELF'])=="menu.php"){


   include "conexion.php";
    $consulta="select * from tbl_proveedores where estado_pv='Activo' order by fecha_creacion_pv desc";
    $resultado=mysqli_query($conexion,$consulta) or die ("Fallas en la consulta");
?>
<div class="ui container">
<br>
<h1>Proveedores registrados</h1>
<br>
<table id="myTable" class="ui red table">
                     <thead>
                        <tr>
                           <th>RUT o NIT</th>
                           <th>Nombre</th>
                           <th>Dirección</th>
                           <th>Correo electrónico</th>
                           <th>Teléfono</th>
                           <th>Fecha de registro</th>
                           <th>Fecha actualización</th>
                           <th>Acciones</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php while ($columna=mysqli_fetch_array($resultado)){ ?>
                        <tr>
                           <td><?php echo $columna['rut_nit_pv'];?></td>
                           <td><?php echo $columna['nombre_pv'];?></td>
                           <td><?php echo $columna['direccion_pv'];?></td>
                           <td><?php echo $columna['correo_pv'];?></td>
                           <td><?php echo $columna['telefono_pv'];?></td>
                           <td><?php echo $columna['fecha_creacion_pv'];?></td>
                           <td><?php echo $columna['fecha_actualizacion_pv'];?></td>
                           <td><a name="btn_actualizar" href="menu.php?mod=actualizarproveedor&id=<?php echo $columna['rut_nit_pv']; ?>"><i class="bx bx-edit icon"></i>ACTUALIZAR</a></td>
                           <td><a name="btn_eliminar" onclick="borrar('<?php echo $columna['rut_nit_pv'];?>')" href="#"><i class="bx bx-trash icon"></i>BORRAR</a></td>
                        </tr>
                        <?php } 
                    mysqli_close($conexion);
                    ?>
                     </tbody>
                 </table>
                 <br>
</div>
<script src="js/sweetalert2@11.js"></script>
<script src="js/dataTables.js"></script>
<!-- <script src="js/jquery-3.7.1.min.js"></script> -->
<script>

$(document).ready( function () {
    $('#myTable').DataTable({
        "ordering": true,
        "columnDefs": [{
            "targets": [8],
            "orderable": false
        },
        {
            "targets": [ 2, 3, 4, 5, 6, 7 ],
            "visible": true,
            "searchable":false
        }],
        language: {
        lengthMenu: "Mostrar _MENU_ registros por página",
        zeroRecords: "Ningún usuario encontrado",
        info: "Mostrando de _START_ a _END_ de un total de _TOTAL_ registros",
        infoEmpty: "Ningún usuario encontrado",
        infoFiltered: "(filtrados desde _MAX_ registros totales)",
        search: "Buscar:",
        loadingRecords: "Cargando...",
        paginate: {
            first: "Primero",
            last: "Último",
            next: "Siguiente",
            previous: "Anterior"
        }
        }
    });
} );

function borrar(codigo) {
    Swal.fire({
        title: "Desea inhabilitar el proveedor?",
        text: "El proveedor pasará a estar inactivo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        confirmButton: true,
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, seguro",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            mandar_phppro(codigo)
        }
    });
}

function mandar_phppro(codigo){
    parametros = {id: codigo};
    $.ajax({
        data: parametros,
        url: "proveedores/eliminarpro.php",
        type: "GET",
        beforeSend: function () {},
        success: function () {
            Swal.fire("Proveedor inhabilitado", "El proveedor pasará a estar inactivo", "success").then((result)=>{
                window.location.href = "menu.php?mod=consultarproveedores"
            })
        }
    })
}


        // function borrar(id){
        //     window.alert("Borrar este proveedor también borrará los productos asociados");
        //     respuesta=confirm("Está seguro de que desea borrar este proveedor?");
        //     if (respuesta){ // SI ES TRUE, ENTRA, DE LO CONTRARIO NO
        //         window.location="proveedores/eliminar.php?id="+id;
        //     }
        // }
    </script>

<?php   
}else{
echo "<script>window.location='../menu.php'</script>";
}
?>