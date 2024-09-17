<?php

if(basename($_SERVER['PHP_SELF'])=="menu.php"){
?>

<?php
include "conexion.php";

// Consulta de productos

$consulta_productos="SELECT COUNT(cod_producto) FROM tbl_productos WHERE estado_pd='Activo'";
$ejecutarconsulta_pd=mysqli_query($conexion,$consulta_productos);
$resultado_pd=mysqli_fetch_array($ejecutarconsulta_pd);

$consulta_productosi="SELECT COUNT(cod_producto) FROM tbl_productos WHERE estado_pd='Inactivo'";
$ejecutarconsulta_pdi=mysqli_query($conexion,$consulta_productosi);
$resultado_pdi=mysqli_fetch_array($ejecutarconsulta_pdi);


// Consulta de proveedores

$consulta_proveedores="SELECT COUNT(rut_nit_pv) FROM tbl_proveedores WHERE estado_pv='Activo'";
$ejecutarconsulta_pv=mysqli_query($conexion,$consulta_proveedores);
$resultado_pv=mysqli_fetch_array($ejecutarconsulta_pv);

$consulta_proveedoresi="SELECT COUNT(rut_nit_pv) FROM tbl_proveedores WHERE estado_pv='Inactivo'";
$ejecutarconsulta_pvi=mysqli_query($conexion,$consulta_proveedoresi);
$resultado_pvi=mysqli_fetch_array($ejecutarconsulta_pvi);

// Consulta de Supermercados

$consulta_supermercados="SELECT COUNT(rut_nit_cli) FROM tbl_supermercados WHERE estado_cli='Activo'";
$ejecutarconsulta_sp=mysqli_query($conexion,$consulta_supermercados);
$resultado_sp=mysqli_fetch_array($ejecutarconsulta_sp);

$consulta_supermercadosi="SELECT COUNT(rut_nit_cli) FROM tbl_supermercados WHERE estado_cli='Inactivo'";
$ejecutarconsulta_spi=mysqli_query($conexion,$consulta_supermercadosi);
$resultado_spi=mysqli_fetch_array($ejecutarconsulta_spi);

// Consulta de usuarios

$consulta_usuarios="SELECT COUNT(doc_admin) FROM tbl_administradores WHERE estado='Activo'";
$ejecutarconsulta_us=mysqli_query($conexion,$consulta_usuarios);
$resultado_us=mysqli_fetch_array($ejecutarconsulta_us);

$consulta_usuariosi="SELECT COUNT(doc_admin) FROM tbl_administradores WHERE estado='Inactivo'";
$ejecutarconsulta_usi=mysqli_query($conexion,$consulta_usuariosi);
$resultado_usi=mysqli_fetch_array($ejecutarconsulta_usi);

?>
<div class="ui container">
    <br>
<div class="cards">
    <div class="card card1">
        <i id="icon-card" class="bx bx-barcode-reader"></i>
        <span class="text">
            <p><b>Productos</b></p>
            <p id="text-active">Activos: <?php echo $resultado_pd['COUNT(cod_producto)']; ?></p>
            <p id="text_inactive">Inactivos: <?php echo $resultado_pdi['COUNT(cod_producto)']; ?></p>
        </span>
    </div>
    <div class="card card2">
        <i id="icon-card" class='bx bxs-truck'></i>                
        <span class="text">
            <p><b>Proveedores</b></p>
            <p id="text-active">Activos: <?php echo $resultado_pv['COUNT(rut_nit_pv)']; ?></p>
            <p id="text_inactive">Inactivos: <?php echo $resultado_pvi['COUNT(rut_nit_pv)']; ?></p>
        </span>
    </div>
    <div class="card card3">
        <i id="icon-card" class='bx bxs-shopping-bags'></i>
        <span class="text">
            <p><b>Supermercados</b></p>
            <p id="text-active">Activos: <?php echo $resultado_sp['COUNT(rut_nit_cli)']; ?></p>
            <p id="text_inactive">Inactivos: <?php echo $resultado_spi['COUNT(rut_nit_cli)']; ?></p>
        </span>
    </div>
    <div class="card card4">
        <i id="icon-card" class='bx bx-list-check'></i>                
        <span class="text">
            <p><b>Usuarios</b></p>
            <p id="text-active">Activos: <?php echo $resultado_us['COUNT(doc_admin)']; ?></p>
            <p id="text_inactive">Inactivos: <?php echo $resultado_usi['COUNT(doc_admin)']; ?></p>
        </span>
    </div>
</div>
<br>
<div class="contente">
    <h1>PRODUCTOS</h1>
    <canvas id="miChart" height="300px" width="800px"></canvas>
    <br>
    <h1></h1>
    <canvas id="miChart2" height="300px" width="800px"></canvas>
</div>
</div>
<script src="js/chart.js"></script>
<script>

document.addEventListener("DOMContentLoaded", function() {
    const ctg=document.getElementById("miChart").getContext('2d');
    const ctg2=document.getElementById("miChart2").getContext('2d');
    
    fetch('estadisticas/cargarDatos.php')
        .then(response => response.json())  // Convertir la respuesta a JSON
        .then(data => {
            const productos=data.productos;
            const cantidad=data.cantidad;

            // Configurar la gráfica con los datos recibidos
            const miChart=new Chart(ctg, {
                type: 'line',
                data: {
                    labels: productos,
                    datasets: [{
                        label: 'Más vendidos',
                        data: cantidad,
                        backgroundColor: 'rgba(183, 38, 241, 0.2)',
                        borderColor: 'rgba(183, 38, 241, 1)',
                        borderWidth: 1.5,
                        fill: true,
                        pointBorderWidth: 4
                    }, 
                ]
                }
            });
        })
        .catch(error=>{
            console.error('Error al obtener los datos');
        });

        fetch('estadisticas/cargarDatos2.php')
        .then(response => response.json())  // Convertir la respuesta a JSON
        .then(data => {
            const productos=data.productos;
            const cantidad=data.cantidad;
        // Configurar la gráfica con los datos recibidos
        const miChart=new Chart(ctg2, {
                type: 'line',
                data: {
                    labels: productos,
                    datasets: [{
                        label: 'Menos vendidos',
                        data: cantidad,
                        backgroundColor: 'rgba(183, 38, 241, 0.2)',
                        borderColor: 'rgba(183, 38, 241, 1)',
                        borderWidth: 1.5,
                        fill: true,
                        pointBorderWidth: 4
                    }, 
                ]
                }
            });
        })
        .catch(error=>{
            console.error('Error al obtener los datos');
        });
});

</script>

<?php   
}else{
   echo "<script>window.location='../menu.php'</script>";
}
?>