<?php

if(!@$_GET['mod']){
     echo "<script>alert('no llegó mod');</script>";
}else{
    echo "<script>alert('si llega mod');</script>";
}
echo basename($_SERVER['PHP_SELF']);
if(basename($_SERVER['PHP_SELF'])=="menu.php"){
    
    echo "<script>alert('LA URL ES DESDE MENÚ');</script>";
}else{
    echo "<script>alert('LA URL NOOOO ES DESDE MENÚ');</script>";
}


if(basename($_SERVER['PHP_SELF'])=="menu.php"){

}else{
   echo "<script>window.location='../menu.php'</script>";
}


?>
<br>
<h1 class="texto">Menú inicial</h1>



<div class="ui container">
    <div class="notificaciones">
        <div class="alerta">
            <i class='bx bxs-message-square-x'></i>
            <div class="contenido">
                <div class="titulo">Error</div>
                <span>Error al insertar</span>
            </div>
            <i class="icono bx bx-x" id="cerrar" onclick="(this.parentElement).remove()"></i>
        </div>
    </div>
</div>




