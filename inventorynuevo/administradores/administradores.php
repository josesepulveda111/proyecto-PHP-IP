<?php
   if(basename($_SERVER['PHP_SELF'])=="menu.php"){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/sweetalert2@11.js"></script>
    <!-- <script src="js/jquery-3.7.1.min.js"></script> -->
</head>
<body>
</body>
</html>
<?php
include "conexion.php";
$consulta = "select * from tbl_administradores where estado='Activo'";
$resultado = mysqli_query($conexion, $consulta) or die("Fallas en la consulta");
?>
<div class="ui container">
    <br>
    <br>
    <div class="notificaciones"></div>
    <h1>Usuarios registrados</h1>
    <br>
    <table class="ui red table">
        <thead>
            <tr>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Direccion</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($columna = mysqli_fetch_array($resultado)) { ?>
                <tr>
                    <td><?php echo $columna['doc_admin'] ?></td>
                    <td><?php echo $columna['primer_n'] . ' ' . $columna['segundo_n'] . ' ' . $columna['primer_a'] . ' ' . $columna['segundo_a'] ?>
                    </td>
                    <td><?php echo $columna['telefono'] ?></td>
                    <td><?php echo $columna['correo'] ?></td>
                    <td><?php echo $columna['direccion'] ?></td>
                    <td><a name="btn_actualizar" href="menu.php?mod=actualizarusuario&id=<?php echo $columna['doc_admin']; ?>"><i
                                class="bx bx-edit icon"></i>ACTUALIZAR</a></td>
                    <td><a name="btn_eliminar" href="#" onclick="borrar('<?php echo $columna['doc_admin'] ?>')"><i
                                class="bx bx-trash icon"></i>BORRAR</a></td>
                </tr>
            <?php }
            mysqli_close($conexion)
                ?>
        </tbody>
        <script>
            function borrar(codigo) {
                Swal.fire({
                    title: "Desea inhabilitar el usuario?",
                    text: "Pasara a estar inactivo.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButton: true,
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, seguro",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        mandar_a(codigo)
                    }
                });
            }

            function mandar_a(codigo) {
                parametros = { id: codigo };
                $.ajax({
                    data: parametros,
                    url: "administradores/eliminara.php",
                    type: "GET",
                    beforeSend: function () { },
                    success: function () {
                        Swal.fire("Usuario inhabilitado", "", "success").then((result) => {
                            window.location.href = "menu.php?mod=consultarusuarios"
                        })
                    }
                })
            }

            let notificaciones = document.querySelector('.notificaciones');

            function crearNotificacion(type, icono, titulo, texto, ok) {
                let nuevaNotificacion = document.createElement('div');
                nuevaNotificacion.innerHTML = `
                    <div class="push ${type}">
                        <i class='${icono}'></i>
                        <div class="contenido">
                            <div class="titulo">${titulo}</div>
                            <span>${texto}</span>
                        </div>
                        <i class="bx bx-x" id="cerrar" onclick="(this.parentElement).remove()"></i>
                    </div>`;
                notificaciones.appendChild(nuevaNotificacion);
                nuevaNotificacion.timeOut = setTimeout(() => nuevaNotificacion.remove(), 2500);
                if (ok == "ok") {
                    setTimeout(() => {
                        // location.href = "administradores.php";
                    }, 3000);
                }
            }
        </script>
    </table>
</div>

<?php   
}else{
   echo "<script>window.location='../menu.php'</script>";
}
?>