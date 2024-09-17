<?php

if(basename($_SERVER['PHP_SELF'])=="menu.php"){

include "conexion.php";
$id=$_GET['id'];
$consulta="SELECT es.id_salida, es.cod_producto,
tbl_productos.nombre_pd as nombreproducto, es.cant_pd, es.precio_compra, es.precio_venta, es.cant_pd*es.precio_venta as subtotal, tbl_salidas.fecha_salida, tbl_salidas.total_salida, tbl_supermercados.rut_nit_cli, tbl_supermercados.nombre_cli, tbl_supermercados.telefono_cli
FROM tbl_productos_salidas as es
INNER JOIN tbl_productos on tbl_productos.cod_producto=es.cod_producto
INNER JOIN tbl_salidas on tbl_salidas.id_salida=es.id_salida
INNER JOIN tbl_supermercados on tbl_supermercados.rut_nit_cli=tbl_salidas.rut_nit_cli
WHERE tbl_salidas.id_salida=$id";
$resultado=mysqli_query($conexion,$consulta) or die ("Fallas en la consulta");
$contador=0;

?>
<div class="ui container">
    <br>
    <h1 class="tituloproductos">Detalle de salida</h1>
    <br>
    <hr>
    <?php while ($columna=mysqli_fetch_array($resultado)){ 
        if($contador==0){?>
    <h4 id="nombre_s">Nombre del supermercado: <?php echo $columna['nombre_cli']; ?></h4>
    <h4 id="rut_s">RUT o NIT del supermercado: <?php echo $columna['rut_nit_cli']; ?></h4>
    <h4 id="celular_s">Contacto del supermercado: <?php echo $columna['telefono_cli']; ?></h4>
    <h4 id="fecha_salida">Fecha salida: <?php echo $columna['fecha_salida']; ?> </h4>
    <h4 id="total_salida">Total salida: $<?php echo $columna['total_salida']; ?> </h4>

    <?php } $contador=$contador+1;} 

        // Reseteamos el puntero de resultados para poder usarlo nuevamente, es decir, poder iterar sobre el ciclo
        mysqli_data_seek($resultado, 0);
    ?>
    <hr>
    <br>


    <table id="detalle-tabla" class="ui striped table">
        <thead>
            <tr>
                <th>Id salida</th>
                <th>Cod producto</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio compra</th>
                <th>Precio venta</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row=mysqli_fetch_array($resultado)){ ?>
            <tr>
                <td><?php echo $row['id_salida']; ?></td>
                <td><?php echo $row['cod_producto']; ?></td>
                <td><?php echo $row['nombreproducto']; ?></td>
                <td><?php echo $row['cant_pd']; ?></td>
                <td><?php echo $row['precio_compra']; ?></td>
                <td><?php echo $row['precio_venta']; ?></td>
                <td><?php echo $row['subtotal']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="centrarboton">
        <a href="menu.php?mod=consultarsalidas" class="positive ui button">Volver</a>
        <span class="espacio"></span>
        <input type="button" class="negative ui button" value="Imprimir" onclick="imprimir()">
    </div>
    <br>
    <script src="js/jspdf.umd.min.js"></script>
    <script src="js/jspdf.plugin.autotable.js"></script>
    <script>

        function imprimir(){
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('p', 'mm', 'a3');

        var title = "Detalle de la salida";
        doc.text(title, 120, 105);

        nombre_s=document.getElementById('nombre_s').textContent;
        doc.text(nombre_s, 25, 125);

        var imagensuperior = new Image();
        imagensuperior.src = "images/membrete_superiorIP.png";
        doc.addImage(imagensuperior, 'PNG', 0, 0, 300, 100); 
        imagensuperior.src = "images/membrete_inferiorIP.png";
        doc.addImage(imagensuperior, 'PNG', 0, 320, 300, 100); 
        var fechasalida = document.getElementById('fecha_salida').textContent;
        doc.text(fechasalida, 25, 140);
        celular_s = document.getElementById('celular_s').textContent;
        doc.text(celular_s, 170, 125);
        rut_s= document.getElementById('rut_s').textContent;
        doc.text(rut_s, 170, 140);


        doc.autoTable({
            styles: {fillColor: [252, 252, 252], textColor: [42, 42, 42]},
            html: '#detalle-tabla',
            theme: 'plain',
            margin: {
                left: 20,
                top:160
            },
        });

        total_salida = document.getElementById('total_salida').textContent;
        doc.text(total_salida, 120, 300);

        doc.save("INVENTORY.pdf");
        }
    </script>

<?php   
}else{
echo "<script>window.location='../menu.php'</script>";
}
?>