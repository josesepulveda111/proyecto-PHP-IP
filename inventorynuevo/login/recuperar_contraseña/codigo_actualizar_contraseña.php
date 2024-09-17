<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/semantic.css">
    <link rel="stylesheet" href="../css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="../js/semantic.js"></script>
    <script src="/inventorynuevo/js/sweetalert2@11.js"></script>
    <title>Actualizar Contraseña</title>
</head>

<body>
<?php
header('Content-Type: text/html; charset=UTF-8');
include '../../conexion.php';
session_start();
if(isset($_SESSION['doc_admin'])){

if(isset($_POST["btn_actualizar_contra"])){

    $documento = $_SESSION['doc_admin'];
    $contraseña_nueva = $_POST["contraseña_nueva"];
    $confirmar_contraseña = $_POST["confirmar_contraseña"];
    $encrip = md5($contraseña_nueva);
    
    
    if($contraseña_nueva == $confirmar_contraseña){
        mysqli_query($conexion, "UPDATE tbl_administradores set contraseña = '$encrip' WHERE doc_admin = '$documento'") or die ($conexion."Eror al actualizar");
        mysqli_query($conexion, "UPDATE tbl_administradores set cambio_contraseña = 1 WHERE doc_admin = '$documento'") or die ($conexion."Eror al actualizar");
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Contraseña actualizada!',
            text: 'La contraseña ha sido actualizada con exito',
        }).then(function(){
            window.location='../../menu.php';;
        });
    </script>";
    }else{
        echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Las contraseñas no coinciden',
                    }).then(function() {
                        window.location='codigo_actualizar_contraseña.php';
                    });
                </script>";
    }
}

?>


    <section>
        <div class="container_recuperar">
            <div class="titulo">
                <h1>ACTUALIZAR CONTRASEÑA</h1>
            </div>
            <form action="codigo_actualizar_contraseña.php" method="post" id="formulario">
                <div class="container_form">
                    <div class="inputbox">
                        <span><i class="bx bx-show-alt" id="icono2"></i></span>
                        <input type="password" name="contraseña_nueva" id="contraseña_nueva" required autocomplete="off" pattern="[A-Za-z0-9]{5,10}" title="Debe contener letras y números, mín 5 máx 15">
                        <label for="">Contraseña Nueva</label>
                    </div>
                </div>
                <div class="container_form">
                    <div class="inputbox">
                        <span><i class="bx bx-show-alt" id="icono2"></i></span>
                        <input type="password" name="confirmar_contraseña" id="confirmar_contraseña" required autocomplete="off" pattern="[A-Za-z0-9]{5,10}" title="Debe contener letras y números, mín 5 máx 15">
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
<script src="validaciones/validarcontra.js"></script>
</html>

<?php
}else{
    echo "<script>window.location='../login.php';</script>";   
}
?>