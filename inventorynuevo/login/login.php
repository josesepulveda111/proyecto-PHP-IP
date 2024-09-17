<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/semantic.css">
    <link rel="stylesheet" href="css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/semantic.js"></script>
    <title>INICIO DE SESIÓN</title>
</head>

<body>
    <section>
        <div class="containerr">
            <div class="titulo">
                <h1>INICIO DE SESIÓN</h1>
            </div>
            <form action="codigo_login.php" method="POST" class="" id="formulario">
                <div class="container_form">
                    <div class="inputbox">
                        <span><i class="bx bx-user" id="icono2"></i></span>
                        <input type="number" name="documento" required autocomplete="off">
                        <label for="">Documento</label>
                    </div>
                </div>
                <div class="container_form">
                    <div class="inputbox">
                        <span><i class="bx bx-show-alt" id="icono"></i></span>
                        <input type="password" name="contraseña" required autocomplete="off" pattern="[A-Za-z0-9]{5,10}" title="Debe contener letras y números, mín 5 máx 15">
                        <label for="">Contraseña</label>
                    </div>
                </div>
                <div style="text-align:center;" class="boton">
                    <button class="ui button" name="btn_login" id="btn_login">INICIAR SESIÓN</button>
                </div>
                <div class="recuperar">
                    <p>¿Olvido su contraseña? <a href="recuperar_contraseña/codigo_recuperar.php">Restablecer contraseña</a></p>
                </div>
                <button class="ui button bx bx-arrow-back" onclick="location.href='../new/index2.html'" id="btn_regresar"></button> 
            </form>
        </div>
    </section>
    <script src="contraseña.js"></script>
</body>

</html>