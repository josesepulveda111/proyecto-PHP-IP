<?php
   if(basename($_SERVER['PHP_SELF'])=="menu.php"){
?>
<body>
    <section>
        <div class="container_actualizar_contra">
            <div class="titulo">
                <h1>ACTUALIZAR CONTRASEÑA</h1>
            </div>
            <form action="administradores/cambiarContraseña.php" method="post" id="formulario">
                
                <div class="container_form">
                    <div class="inputbox">
                        <span><i class="bx bx-show-alt" id="icono2"></i></span>
                        <input type="password" name="contraseña_actual" id="contraseña_actual" required autocomplete="off">
                        <label for="">Contraseña Actual</label>
                    </div>
                </div>

                <div class="container_form">
                    <div class="inputbox">
                        <span><i class="bx bx-show-alt" id="icono2"></i></span>
                        <input type="password" name="contraseña_nueva" id="contraseña_nueva" required autocomplete="off">
                        <label for="">Contraseña Nueva</label>
                    </div>
                </div>

                <div class="container_form">
                    <div class="inputbox">
                        <span><i class="bx bx-show-alt" id="icono2"></i></span>
                        <input type="password" name="confirmar_contraseña" id="confirmar_contraseña" required autocomplete="off">
                        <label for="">Confirmar Nueva Contraseña</label>
                    </div>
                </div>

                <div style="text-align:center;" class="boton">
                <button class="ui button" name="btn_actualizar_contra" id="btn_actualizar_contra">Actualizar</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>

<?php   
}else{
   echo "<script>window.location='../menu.php'</script>";
}
?>