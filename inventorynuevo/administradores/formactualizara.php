<?php
   if(basename($_SERVER['PHP_SELF'])=="menu.php"){
?>

<?php
include "conexion.php";
$doc_admin = $_GET['id'];
$consulta = "SELECT * from tbl_administradores WHERE doc_admin = '$doc_admin'";
$ejecutarconsulta = mysqli_query($conexion, $consulta);
$resultado = mysqli_fetch_array($ejecutarconsulta);
?>
<div class="ui container">
    <br>
    <h1>Actualizar usuario</h1>
    <br>
    <div class="notificaciones"></div>
    <form class="ui form" method="POST" id="formulario">
        <div class="three fields">
            <div class="field">
                <label for="">Documento</label>
                <input type="text" id="documento" name="documento" value="<?php echo $resultado['doc_admin']; ?>"
                    required>
                <input type="hidden" id="doc" name="doc" value="<?php echo $resultado['doc_admin'] ?>">
            </div>
            <div class="field">
                <label for="">Primer nombre</label>
                <input type="text" id="primer_nombre" name="primer_nombre" value="<?php echo $resultado['primer_n'] ?>"
                    required>
            </div>
            <div class="field">
                <label for="">Segundo nombre</label>
                <input type="text" id="segundo_nombre" name="segundo_nombre"
                    value="<?php echo $resultado['segundo_n'] ?>" required>
            </div>
        </div>
        <div class="three fields">
            <div class="field">
                <label for="">Primer apellido</label>
                <input type="text" id="primer_apellido" name="primer_apellido"
                    value="<?php echo $resultado['primer_a'] ?>" required>
            </div>
            <div class="field">
                <label for="">Segundo apellido</label>
                <input type="text" id="segundo_apellido" name="segundo_apellido"
                    value="<?php echo $resultado['segundo_a'] ?>" required>
            </div>
            <div class="field">
                <label for="">Telefono</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo $resultado['telefono'] ?>" required>
            </div>
        </div>
        <div class="two fields">
            <div class="field">
                <label for="">Correo</label>
                <input type="text" id="correo" name="correo" value="<?php echo $resultado['correo'] ?>" required>
            </div>
            <div class="field">
                <label for="">Direccion</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo $resultado['direccion'] ?>"
                    required>
            </div>
        </div>
        <div class="boton">
            <input type="submit" class="ui green button" value="GUARDAR" name="actualizar">
        </div>
    </form>
</div>
<script>
    document.getElementById("formulario").addEventListener('submit', function (e) {
        e.preventDefault();

        documento = document.getElementById("documento").value;
        doc = document.getElementById("doc").value;
        primer_n = document.getElementById("primer_nombre").value;
        segundo_n = document.getElementById("segundo_nombre").value;
        primer_a = document.getElementById("primer_apellido").value;
        segundo_a = document.getElementById("segundo_apellido").value;
        telefono = document.getElementById("telefono").value;
        correo = document.getElementById("correo").value;
        direccion = document.getElementById("direccion").value;


        let formaData = new FormData();


        formaData.append("documento", documento);
        formaData.append("doc", doc);
        formaData.append("primer_n", primer_n);
        formaData.append("segundo_n", segundo_n);
        formaData.append("primer_a", primer_a);
        formaData.append("segundo_a", segundo_a);
        formaData.append("telefono", telefono);
        formaData.append("correo", correo);
        formaData.append("direccion", direccion);
        console.log(formaData)
        let url = "administradores/actualizara.php"
        fetch(url, {
            method: "POST",
            body: formaData
        }).then(response => response.text())
            .then(data => {
                if (data == 2) {
                    crearNotificacion('error', 'bx bxs-message-square-x', 'Error', 'Usuario existente', "okk");
                } else if (data == 1) {
                    crearNotificacion('correcta', 'bx bxs-check-circle', 'Actualizado', 'Actualizado correctamente', "ok");
                } else {
                    crearNotificacion('error', 'bx bxs-message-square-x', 'Error', 'Error al insertar: ' + data);
                    console.log(data)
                }
            })
    });

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
        nuevaNotificacion.timeOut = setTimeout(() => nuevaNotificacion.remove(), 3500);
        if (ok == "ok") {
            setTimeout(() => {
                window.location.href = "menu.php?mod=consultarusuarios";
            }, 3000);
        }
    }


    function guardarDatos() {
        localStorage.Documento = document.getElementById("documento").value;
        localStorage.Primer_n = document.getElementById("primer_nombre").value;
        localStorage.Segundo_n = document.getElementById("segundo_nombre").value;
        localStorage.Primer_a = document.getElementById("primer_apellido").value;
        localStorage.Segundo_a = document.getElementById("segundo_apellido").value;
        localStorage.Telefono = document.getElementById("telefono").value;
        localStorage.Correo = document.getElementById("correo").value;
        localStorage.Direccion = document.getElementById("direccion").value;
    }

    function recuperarDatos() {
        document.getElementById("documento").value = localStorage.Documento
        document.getElementById("primer_nombre").value = localStorage.Primer_n
        document.getElementById("segundo_nombre").value = localStorage.Segundo_n
        document.getElementById("primer_apellido").value = localStorage.Primer_a
        document.getElementById("segundo_apellido").value = localStorage.Segundo_a
        document.getElementById("telefono").value = localStorage.Telefono
        document.getElementById("correo").value = localStorage.Correo
        document.getElementById("direccion").value = localStorage.Direccion
    }
</script>

<?php   
}else{
   echo "<script>window.location='../menu.php'</script>";
}
?>