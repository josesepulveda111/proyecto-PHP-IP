<?php
   include "conexion.php";
   $consulta="select * from tbl_productos where estado_pd='Activo' order by fecha_creacion_pd desc";
   $resultado=mysqli_query($conexion,$consulta) or die ("Fallas en la consulta");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>INVENTORY PLUS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="theme-name" content="godocs-bulma" />
  <link rel="stylesheet" href="plugins/bulma/bulma.min.css">
  <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
  <link href="css/estilos.css" rel="stylesheet">
  <link rel="stylesheet" href="css/css/font-awesome.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<header class="contenedor-inicial">
        <a href="/inventorynuevo/new/index2.html" class="logo">INVENTORY+</a>
        <input type="checkbox" id="check">
        <label for="check" class="icons">
            <i class="bx bx-menu" id="menu-icon"></i>
            <i class="bx bx-x" id="close-icon"></i>
        </label>
        <nav class="menu-principal">
            <a href="/inventorynuevo/login/login.php" style="--i:0;">Gestion</a>
            <a href="../new/cards_productos.php" style="--i:1;">Productos</a>
            <a href="../new/cards_proveedores.php" style="--i:2;">Proveedores</a>
            <a href="../new/cards_supermercados.php" style="--i:3;">Supermercados</a>
            <a href="/inventorynuevo/login/login.php" class="btn btn-primary" id="button-login">Iniciar sesión</a>
        </nav>
</header>

<section class="section pb-0">
   <div class="container">
      <br><br>
      <h2 class="section-title">Productos
      </h2>
      <div class="columns is-multiline">
      <?php while ($columna=mysqli_fetch_array($resultado)){ ?>
         <div class="column is-3-widescreen is-4-desktop is-6-tablet">
            <div class="card match-height">
               <div class="card-body">
                  <img class="imagen-card" src="../images/image.png" alt="IMAGEN PRODUCTO">
                  <br><br>
                  <h3 class="card-title h4"><?php echo $columna['nombre_pd'];?></h3>
                  <p class="card-text"><?php echo $columna['descrip_pd'];?></p>
                  <p class="card-text"><?php echo $columna['precio_compra'];?></p>
               </div>
            </div> 
         </div>
         <?php } mysqli_close($conexion); ?>
      </div>
   </div>
</section>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<footer>
        <img src="" alt="" class="logo-footer">
        <div class="social-icons">
            <a href="https://oferta.senasofiaplus.edu.co/sofia-oferta/" class="social-icon"></a>
            <a href="https://wa.me/573116277698" class="social-icon"></a>
            <a href="" class="social-icon"></a>
            <a href="" class="social-icon"></a>
        </div>
        <ul class="menu-footer">
            <li class="menu-item"><a href="https://zajuna.sena.edu.co/" id="item-menu">Entidad</a></li>
            <li class="menu-item"><a href="https://wa.me/573116277698" id="item-menu">Contacto</a></li>
            <li class="menu-item"><a href="http://centrotgi.blogspot.com/" id="item-menu">Centro</a></li>
        </ul>
        <span class="copyright">Copy © 2023 - Diseñado y desarrollado por ADSO 2697890 - SENA</span>
    </footer>
<script src="js/script.js"></script>
</body>
</html>
