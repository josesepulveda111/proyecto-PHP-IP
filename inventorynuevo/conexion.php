 
   <?php 
    $usuario='root';
    $password='';
    $servidor='localhost';
    $bd='inventory';
    // $conexion=mysqli_connect($servidor,$usuario,$password,$bd) or die ("Sin conexion");
    // ESTO PRIMERO VALIDA QUE SE HAYA INGRESADO AL GESTOR DE BASE DE DATOS (USUARIO, CONTRASEÑA...), DESPUÉS SE SELECCIONA LA BASE DE DATOS
    $conexion=mysqli_connect($servidor,$usuario,"") or die ("Sin conexion");
    $db=mysqli_select_db($conexion,$bd) or die ("Sin conexión");
    ?>