<?php
if(basename($_SERVER['PHP_SELF'])=="menu.php"){

include "conexion.php";
$id=$_GET['id'];
$consulta="SELECT ep.id_entrada, ep.cod_producto,
tbl_productos.nombre_pd as nombreproducto, ep.cant_pd, ep.precio_compra, ep.precio_venta, ep.cant_pd*ep.precio_venta as subtotal, tbl_entradas.fecha_entrada, tbl_entradas.total_entrada, tbl_proveedores.rut_nit_pv, tbl_proveedores.nombre_pv, tbl_proveedores.telefono_pv
FROM tbl_entradas_productos as ep
INNER JOIN tbl_productos on tbl_productos.cod_producto=ep.cod_producto
INNER JOIN tbl_entradas on tbl_entradas.id_entrada=ep.id_entrada
INNER JOIN tbl_proveedores on tbl_proveedores.rut_nit_pv=tbl_productos.rut_nit_pv
WHERE tbl_entradas.id_entrada=$id";
$resultado=mysqli_query($conexion,$consulta) or die ("Fallas en la consulta");
$contador=0;

?>
<div class="ui container">
    <br>
    <h1 class="tituloproductos">Detalle de entradas</h1>
    <br>
    <hr>
    <?php while ($columna=mysqli_fetch_array($resultado)){ 
        if($contador==0){?>
    <h4 id="nombrecliente">Nombre del cliente/proveedor: <?php echo $columna['nombre_pv']; ?></h4>
    <h4 id="rutcliente">RUT del cliente: <?php echo $columna['rut_nit_pv']; ?></h4>
    <h4 id="celularcliente">Celular del cliente: <?php echo $columna['telefono_pv']; ?></h4>
    <h4 id="fecha_entrada">Fecha entrada: <?php echo $columna['fecha_entrada']; ?> </h4>
    <h4 id="totalEntrada">Total entrada: $<?php echo $columna['total_entrada']; ?> </h4>

    <?php } $contador=$contador+1;} 

        // Reseteamos el puntero de resultados para poder usarlo nuevamente, es decir, poder iterar sobre el ciclo
        mysqli_data_seek($resultado, 0);
    ?>
    <hr>
    <br>


    <table id="detalle-tabla" class="ui striped table">
        <thead>
            <tr>
                <th>Id entrada</th>
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
                <td><?php echo $row['id_entrada']; ?></td>
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
        <a href="menu.php?mod=consultarentradas" class="positive ui button">Volver</a>
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

        var title = "Detalle de la entrada";
        doc.text(title, 120, 105);

        nombrecliente=document.getElementById('nombrecliente').textContent;
        doc.text(nombrecliente, 25, 125);

        var imagensuperior = new Image();
        imagensuperior.src = "images/membrete_superiorIP.png";
        doc.addImage(imagensuperior, 'PNG', 0, 0, 300, 100); 
        imagensuperior.src = "images/membrete_inferiorIP.png";
        doc.addImage(imagensuperior, 'PNG', 0, 320, 300, 100); 
        var fechafactura = document.getElementById('fecha_entrada').textContent;
        doc.text(fechafactura, 25, 140);
        celularcliente = document.getElementById('celularcliente').textContent;
        doc.text(celularcliente, 170, 125);
        rutcliente = document.getElementById('rutcliente').textContent;
        doc.text(rutcliente, 170, 140);


        doc.autoTable({
            styles: {fillColor: [252, 252, 252], textColor: [42, 42, 42]},
            html: '#detalle-tabla',
            theme: 'plain',
            margin: {
                left: 20,
                top:160
            },
        });

        totalEntrada = document.getElementById('totalEntrada').textContent;
        doc.text(totalEntrada, 120, 300);

        doc.save("INVENTORY.pdf");
        }
    </script>

<?php   
}else{
echo "<script>window.location='../menu.php'</script>";
}
?>