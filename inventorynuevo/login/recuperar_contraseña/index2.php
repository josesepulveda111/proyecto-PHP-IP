<?php 
include '../../conexion.php';
session_start();
if(isset($_SESSION['doc_admin'])){
?>



<?php
}else{
    echo "<script>window.location='../login.php';</script>";   
}
?>