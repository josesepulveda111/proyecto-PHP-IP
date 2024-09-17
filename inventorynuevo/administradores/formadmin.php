<?php
   if(basename($_SERVER['PHP_SELF'])=="menu.php"){
?>

<div class="ui container">
    <div class="notificacion">
        <!-- <div class="push">
            <i class='bx bxs-message-square-x'></i>
            <div class="contenido">
                <div class="tituloAlerta">Error</div>
                <span>Usuario existente</span>
            </div>
            <i class="bx bx-x" id="cerrar" onclick="(this.parentElement).remove()"></i>
        </div> -->
    </div>
    <br>
    <h1>Formulario de registro de usuarios</h1>
    <br>
    <form class="ui form" id="formulario" method="POST">
        <div class="three fields">
            <div class="field">
                <label for="documento">Documento</label>
                <input type="number" id="documento" name="documento" required>
            </div>
            <div class="field">
                <label for="primer_nombre">Primer nombre</label>
                <input type="text" id="primer_nombre" name="primer_nombre" required>
            </div>
            <div class="field">
                <label for="segundo_nombre">Segundo nombre</label>
                <input type="text" id="segundo_nombre" name="segundo_nombre" required>
            </div>
        </div>
        <div class="three fields">
            <div class="field">
                <label for="primer_apellido">Primer apellido</label>
                <input type="text" id="primer_apellido" name="primer_apellido" required>
            </div>
            <div class="field">
                <label for="segundo_apellido">Segundo apellido</label>
                <input type="text" id="segundo_apellido" name="segundo_apellido" required>
            </div>
            <div class="field">
                <label for="telefono">Telefono</label>
                <input type="text" id="telefono" name="telefono" required>
            </div>
        </div>
        <div class="two fields">
            <div class="field">
                <label for="correo">Correo</label>
                <input type="text" id="correo" name="correo" required>
            </div>
            <div class="field">
                <label for="direccion">Direccion</label>
                <input type="text" id="direccion" name="direccion" required>
            </div>
        </div>
        <div class="boton">
            <input type="submit" class="ui green button" onclick="guardarDatos()" value="GUARDAR" name="guardar">
            <input type="button" class="ui orange button" onclick="recuperarDatos()" value="RECUPERAR DATOS">
            <input class="ui red button" type="reset" value="BORRAR DATOS">
        </div>
    </form>
</div>
<script>
    document.getElementById("formulario").addEventListener('submit', function (e) {
        e.preventDefault();

        documento = document.getElementById("documento").value;
        primer_n = document.getElementById("primer_nombre").value;
        segundo_n = document.getElementById("segundo_nombre").value;
        primer_a = document.getElementById("primer_apellido").value;
        segundo_a = document.getElementById("segundo_apellido").value;
        telefono = document.getElementById("telefono").value;
        correo = document.getElementById("correo").value;
        direccion = document.getElementById("direccion").value;


        let formaData = new FormData();


        formaData.append("documento", documento);
        formaData.append("primer_n", primer_n);
        formaData.append("segundo_n", segundo_n);
        formaData.append("primer_a", primer_a);
        formaData.append("segundo_a", segundo_a);
        formaData.append("telefono", telefono);
        formaData.append("correo", correo);
        formaData.append("direccion", direccion);
        // console.log(documento,"", primer_n, "", segundo_n, "", primer_a, "", segundo_a, "",telefono, "",correo, "", direccion,"", contraseña);
        let url = "administradores/registrara.php";
        fetch(url, {
            method: "POST",
            body: formaData
        }).then(response => response.text())
            .then(data => {
                if (data == 2) {
                    crearNotificacion('correcta', 'bx bxs-check-circle', 'Registro exitoso', 'Se ha insertado correctamente', "ok");

                } else if (data == 1) {
                    crearNotificacion('errorr', 'bx bxs-message-square-x', 'Error', 'Usuario existente', "okk");
                } else {
                    crearNotificacion('errorr', 'bx bxs-message-square-x', 'Error', 'Error al insertar: ' + data);
                }
            })
    });

    let notificaciones = document.querySelector('.notificacion');

    function crearNotificacion(type, icono, titulo, texto, ok) {
        let nuevaNotificacion = document.createElement('div');
        nuevaNotificacion.innerHTML = `
                    <div class="push ${type}">
                        <i class='${icono}'></i>
                        <div class="contenido">
                            <div class="tituloAlerta">${titulo}</div>
                            <span>${texto}</span>
                        </div>
                        <i class="bx bx-x" id="cerrar" onclick="(this.parentElement).remove()"></i>
                    </div>`;
        notificaciones.appendChild(nuevaNotificacion);
        nuevaNotificacion.timeOut = setTimeout(() => nuevaNotificacion.remove(), 5000);
        if (ok == "ok") {
            setTimeout(() => {
                location.href = "menu.php?mod=consultarusuarios";
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