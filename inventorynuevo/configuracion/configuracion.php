<!-- <div class="ui container"> -->
    <div class="ui container" id="confi">
        <br>
        <div class="titulo">
            <h1>Configuración general</h1>
        </div>
        <br>
        <section class="perfil ui padded raised segment">
            <div class="item-usuario"><i class="bx bx-user-circle usuario"></i></div>
            <div class="item-perfil">Mi perfil</div>
            <form action="configuracion/actualizar.php" class="ui form" method="POST">
                <div class="field">
                    <div class="field">
                        <label for="">Dirección</label>
                        <input type="text" name="direccion" value="<?php echo $_SESSION['direccion']; ?>">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label for="">Nombre</label>
                        <input type="text" name="primer_n" value="<?php echo $_SESSION['primer_n']; ?>">
                    </div>
                    <div class="field">
                        <label for="">Apellido</label>
                        <input type="text" name="primer_a" value="<?php echo $_SESSION['primer_a']; ?>">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label for="">Teléfono</label>
                        <input type="text" name="telefono" value="<?php echo $_SESSION['telefono']; ?>">
                    </div>
                    <div class="field">
                        <label for="">Correo</label>
                        <input type="text" name="correo" value="<?php echo $_SESSION['correo']; ?>">
                    </div>
                </div>
                <div class="boton">
                    <button class="ui primary button" name="btn_actualizar" onclick="actualizar('<?php echo $_SESSION['doc_admin'] ?>')">Actualizar</button>
                </div>
            </form>

        </section>
        <br>
        <label class="label_icon" for="">Notificaciones</label><i class="bx bx-bell espacio_icon"></i>
        <section class="perfil ui padded raised segment">
            <div class="itemm" id="texto">¿Cómo quieres recibir las alertas acerca del stock de los productos?</div>
            <br>
            <div class="itemm">
                <div class="mensaje">
                    <i class="bx bx-envelope icono"></i>Correo electrónico
                </div>
                <i class="bx bx-toggle-left" id="activar"></i>
            </div>
            <div class="itemm">
                <div class="mensaje">
                    <i class="bx bx-chat icono"></i>SMS
                </div>
                <i class="bx bx-toggle-left" id="activar"></i>
            </div>
        </section>
        <br>
        <label class="label_icon" for="">Apariencia</label><i class="bx bx-adjust espacio_icon"></i>
        <section class="perfil ui padded raised segment">
            <br>
            <div class="itemm">
                <div class="mensaje">
                    <i class="bx bx-moon icono"></i>Tema oscuro
                </div>
                <i class="bx bx-toggle-left" id="oscuro"></i>
            </div>
        </section>
        <br>
    </div>
<!-- </div> -->
<script src="js/modo_oscuro.js"></script> 
</script>