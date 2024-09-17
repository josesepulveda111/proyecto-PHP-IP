<?php

include "../conexion.php";
session_start();

    if(isset($_POST["btn_actualizar_contra"])){

    $documento = $_SESSION["doc_admin"];
    $contraseña_actual = $_POST["contraseña_actual"];
    $contraseña_nueva = $_POST["contraseña_nueva"];
    $confirmar_contraseña = $_POST["confirmar_contraseña"];

    $encrip_contra_actual = md5($contraseña_actual);
    $encrip_contra_nueva = md5($contraseña_nueva);

    $consultar = mysqli_query($conexion, "SELECT * FROM tbl_administradores WHERE doc_admin = '$documento'; ") or die ("Error en la consulta: " . mysqli_error($conexion));

    $resultado = mysqli_num_rows($consultar);

    if($resultado != 0){

        if($contraseña_actual == $contraseña_nueva and $contraseña_actual == $confirmar_contraseña){
            echo "<script>alert('La contraseña nueva no puede ser igual a la contraseña actual');</script>";
            echo "<script>window.location='../menu.php?mod=actualizarcontra';</script>";
        }elseif($contraseña_nueva == $confirmar_contraseña){
            mysqli_query($conexion, "UPDATE tbl_administradores set contraseña = '$encrip_contra_nueva' WHERE contraseña = '$encrip_contra_actual'") or die ($conexion."Eror al actualizar");
            
            echo "<script>alert('Contraseña actualizada con exito');</script>";
            echo "<script>window.location='../menu.php?mod=actualizarcontra';</script>";
        }else{
            echo "<script>alert('Las contraseñas no coinciden');</script>";
            echo "<script>window.location='../menu.php?mod=actualizarcontra';</script>";
        }
    }else{
        echo "<script>alert('La contraseña actual no es correcta');</script>";
        echo "<script>window.location='../menu.php?mod=actualizarcontra';</script>";
    }
    }




?>