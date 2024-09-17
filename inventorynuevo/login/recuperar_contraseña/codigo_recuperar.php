<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/inventorynuevo/js/sweetalert2@11.js"></script>
    <link rel="stylesheet" href="../css/semantic.css">
    <link rel="stylesheet" href="../css/login.css">
    <link href='/inventorynuevo/css/boxicons.min.css' rel='stylesheet'>
    <script src="../js/semantic.js"></script>
    <title>Recuperar contraseña</title>
</head>
<body> -->
    
<?php
// header('Content-Type: text/html; charset=UTF-8');
// include '../../conexion.php';
// require("mail.php");

// if(isset($_POST["btn_recuperar_contra"])){
//     $email = $_POST["correo"];

//     $consultar = mysqli_query($conexion, "SELECT * FROM tbl_administradores WHERE correo = '$email'; ") or die ("Error en la consulta: " . mysqli_error($conexion));

//     $resultado = mysqli_num_rows($consultar);
    
//     if($resultado !=  0){
//         $email = $_POST["correo"];
//         $name = "Inventory Plus";
//         $subject ="Codigo de inicio de sesion temporal";
//         $message = random_int(100000, 999999);
//         $encrip = md5($message);
//         $body = "$name <br><br> Este será su código de inicio de sesión temporal, inicie sesión nuevamente al aplicativo utilizando este código como contraseña. Atentamente, INVENTORY PLUS <br><br> $message";
//         SendEmail($subject, $body, $email, $name);

//         mysqli_query($conexion, "UPDATE tbl_administradores set contraseña = '$encrip' WHERE correo = '$email'") or die ($conexion."Eror al actualizar");

//         mysqli_query($conexion, "UPDATE tbl_administradores set cambio_contraseña = 2 WHERE correo = '$email'") or die ($conexion."Eror al actualizar");
        
//         echo "<script>
//         Swal.fire({
//             icon: 'success',
//             title: 'Correo electrónico enviado!',
//             text: 'A su correo fue enviado el código de acceso',
//         }).then(function(){
//             window.location.href = '../login.php';
//         });
//         </script>";
//     }else{
//         echo "<script>
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'El correo ingresado no coincide con ninguno de nuestros registros',
//                     }).then(function() {
//                         window.location='codigo_recuperar.php';
//                     });
//                 </script>";
//     }
// }

?>
<!-- <section>
        <div class="container_recuperar">
            <div class="titulo">
                <h1>RECUPERAR CONTRASEÑA</h1>
            </div>
            <form action="codigo_recuperar.php" method="post" id="formulario">
                <div class="titulo_2">
                    <h4>Ingrese su correo electrónico para continuar con el proceso de restablecimiento de contraseña</h4>
                </div>
                <br>
                <div class="container_form">
                    <div class="inputbox">
                        <span><i class="bx bx-user" id="icono2"></i></span>
                        <input type="email" name="correo" id="correo" required autocomplete="on">
                        <label for="">Correo Electrónico</label>
                    </div>
                </div>

                <div style="text-align:center;" class="boton">
                <button class="ui button" name="btn_recuperar_contra" id="btn_recuperar_contra">Enviar Codigo</button>
                </div>
                <button class="ui button bx bx-arrow-back" onclick="location.href='../login.php'" id="btn_regresar"></button>
            </form>
        </div>
    </section>
</body>

</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/inventorynuevo/js/sweetalert2@11.js"></script>
    <link rel="stylesheet" href="../css/semantic.css">
    <link rel="stylesheet" href="../css/login.css">
    <link href='/inventorynuevo/css/boxicons.min.css' rel='stylesheet'>
    <script src="../js/semantic.js"></script>
    <title>Recuperar contraseña</title>
</head>
<body>
    
<?php
// header('Content-Type: text/html; charset=UTF-8');
include '../../conexion.php';
require("mail.php");

if(isset($_POST["btn_recuperar_contra"])){
    $documentoAdmin=$_POST["doc_admin"];

    $consultar=mysqli_query($conexion, "SELECT doc_admin, correo FROM tbl_administradores WHERE doc_admin= '$documentoAdmin'; ") or die ("Error en la consulta: ");

    $resultado=mysqli_num_rows($consultar);

    if($resultado!=0){
        while ($columna=mysqli_fetch_array($consultar)){
            $correo=$columna['correo'];
        }
        
    function generatePassword($length){
        $key = "";
        $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
        $max = strlen($pattern)-1;
        for($i = 0; $i < $length; $i++){
            $key .= substr($pattern, mt_rand(0,$max), 1);
        }
        return $key;
    }

        $name = "Inventory Plus";
        $subject ="Codigo de inicio de sesion temporal";
        $message = generatePassword(10);
        $encrip = md5($message);
        $body = "$name <br><br> Este será su código de inicio de sesión temporal, inicie sesión nuevamente al aplicativo utilizando este código como contraseña. <br><br> Atentamente, <br><br>INVENTORY PLUS <br><br> <b>EL CÓDIGO ES:</b> $message";
        SendEmail($subject, $body, $correo, $name);

        mysqli_query($conexion, "UPDATE tbl_administradores set contraseña='$encrip', cambio_contraseña=2 WHERE doc_admin='$documentoAdmin'") or die ($conexion."Error al actualizar");

    //     mysqli_query($conexion, "UPDATE tbl_administradores set cambio_contraseña = 2 WHERE correo = '$email'") or die ($conexion."Eror al actualizar");
        
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Correo electrónico enviado!',
            text: 'A su correo fue enviado el código de acceso',
        }).then(function(){
            window.location.href = '../login.php';
        });
        </script>";
    }else{
        echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'El documento ingresado no coincide con ninguno de nuestros registros',
                    }).then(function() {
                        window.location='codigo_recuperar.php';
                    });
                </script>";
    }
}

?>
<section>
        <div class="container_recuperar">
            <div class="titulo">
                <h1>RECUPERAR CONTRASEÑA</h1>
            </div>
            <form action="codigo_recuperar.php" method="post" id="formulario">
                <div class="titulo_2">
                    <h4>Ingrese su documento para continuar con el proceso. A su correo electrónico llegará el código de acceso</h4>
                </div>
                <br>
                <div class="container_form">
                    <div class="inputbox">
                        <span><i class="bx bx-user" id="icono2"></i></span>
                        <input type="number" name="doc_admin" id="doc_admin" required autocomplete="off">
                        <label for="">Documento</label>
                    </div>
                </div>

                <div style="text-align:center;" class="boton">
                <button class="ui button" name="btn_recuperar_contra" id="btn_recuperar_contra">Enviar código</button>
                </div>
                <button class="ui button bx bx-arrow-back" onclick="location.href='../login.php'" id="btn_regresar"></button>
            </form>
        </div>
    </section>
</body>

</html>



