<?php

    if(basename($_SERVER['PHP_SELF'])=="menu.php"){

    include "conexion.php";
?>

<div class="ui container">
    <br>
    <h1>Formulario de registro de entradas</h1>
    <br>
    <div class="notificaciones">
        <!-- <div class="alerta">
            <i class='bx bxs-message-square-x'></i>
            <div class="contenido">
                <div class="titulo">Error</div>
                <span>Error al insertar</span>
            </div>
            <i class="icono bx bx-x" id="cerrar" onclick="(this.parentElement).remove()"></i>
        </div> -->
    </div>
    <a href="menu.php?mod=consultarentradas" class="ui button btn_consultar">Consultar entradas</a>
    <form class="ui fluid form" action="entradas/registrar.php" method="POST">
        <br>
        <div class="field">
                <?php
                // Sentencia SQL para consultar los proveedores
                $consultaProveedor="SELECT * FROM tbl_proveedores where estado_pv='Activo'";
                // Obtenemos los resultadps
                $resultadoConsulta=mysqli_query($conexion, $consultaProveedor);
                ?>
    
            <label for="">Proveedor</label>
            <select class="ui fluid search dropdown" name="proveedor" id="proveedor" required>
                <option value="">Seleccione el proveedor</option>

                <?php
                // Desde que haya resultados, los mostramso
                while($consulta=mysqli_fetch_array($resultadoConsulta)){ ?>

                  <option value="<?php echo $consulta['rut_nit_pv']; ?>"><?php echo $consulta['nombre_pv']; ?></option>
                  
                <?php
                }
                ?>

            </select>
        </div>
        <h3>Detalle de la entrada</h3>
        <button class="ui primary button" type="button" onclick="agregar()"><i class="add icon"></i>Agregar nuevo producto</button>
        <table class="ui red table">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Nombre producto</th>
                <th>Cantidad producto</th>
                <th>Precio de venta</th>
                <th>Subtotal</th>
                <th class="cols" colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody id="content">
            <tr id="f1">
                <td>1</td>
                <td>
                    <!-- con id mandamos el id del select para que consulte el valor, en 1 (fila) mandamos el id a modificar de la cantidad -->
                    <select class="ui fluid search dropdown" name="idproductos[]" id="idproductos1" onchange="mostrarDatos(id, 1)" required>
                        <option value="">Seleccione el producto</option>
                    </select>
                </td>
                <td><input type="number" name="cantidadproductos[]" id="cantidadproductos1" min="1" oninput="sumarCantidad(event, 1)" required></td>
                <td>
                    <input type="number" name="" id="precioventaMostrar1" disabled>
                    <!-- ESTOS SON LOS QUE SE VAN A ENVIAR -->
                    <input type="hidden" name="precioventa[]" id="precioventa1">
                    <input type="hidden" name="preciocompra[]" id="preciocompra1">
                </td>
                <td>$<span id="subtotal1">0</span></td>
                <!-- Mandamos el id, que se va a concatenar -->
                <td><button class="ui basic button" type="button" onclick="agregarCantidad(1)"><i class="bx bx-plus colorverde"></i></button></td>
                <td><button type="button" class="ui basic button" onclick="restarCantidad(1)"><i class="bx bx-minus colorrojo"></i></button></td>
            </tr>
        </tbody>
        <tr>
            <th colspan="7">TOTAL ENTRADA: $<span id="totalFactura">0</span></th>
            <input type="hidden" name="totalEntrada" id="totalFacturaInput">
        </tr>
        <br>
    </table>
        <div class="centrarboton">
            <input type="submit" name="btn_insertar" value="Guardar entrada" class="positive ui button">
            <span class="espacio"></span>
            <a href="#" class="negative ui button">Cancelar</a>
        </div>
    </form>

</div>

<script>

    let notificaciones = document.querySelector('.notificaciones');

    function crearNotificacion(texto) {
        let nuevaNotificacion = document.createElement('div');
        nuevaNotificacion.innerHTML=`
                <div class="alerta">
                    <i class='bx bxs-message-square-x'></i>
                    <div class="contenido">
                        <div class="tituloa">Error</div>
                        <span>${texto}</span>
                    </div>
                    <i class="icono bx bx-x" id="cerrar" onclick="(this.parentElement).remove()"></i>
                </div>`;
    notificaciones.appendChild(nuevaNotificacion);
    nuevaNotificacion.timeOut = setTimeout(() => nuevaNotificacion.remove(), 4000);
    
    }

    c=2; // Es el contador de cada fila, para asignar id en incremento en cada select respectivamente
    f=1; // Reconoce el número de selects ingresados, para el ciclo for de fetch

    // Calcular total de la factura (no es la forma más práctica, corregirla con el método onchange y con variable, onchange en cada elemento, accediendo al subtotal)
    function facturaTotal(){
        const totalFactura=document.getElementById("totalFactura");
        const totalFacturaInput=document.getElementById("totalFacturaInput")
        operacion=0;

        for (let i=1; i<=f; i++){

            // Se valida que encuentre el subtotal, con el fin de que no genere error al no encontrar (ya que incrementa y se eliminan filas)
            if(document.getElementById("subtotal"+i)){
                let subtotales=parseInt(document.getElementById("subtotal"+i).textContent);
                operacion+=subtotales;
            }
        }
        totalFactura.innerHTML=operacion
        totalFacturaInput.value=operacion
    }

    // Función para reducir la cantidad de cada input
    function restarCantidad(idNumero){

        // Obtenemos la cantidad actual
        let cantidad=document.getElementById("cantidadproductos"+idNumero).value;
        
        // Consultamos si el select está seleccionado
        let select="idproductos"+idNumero;
        let selectValor=document.getElementById(select).value;

        // Si no está el select seleccionado
        if(!selectValor){
            // alert("No ha seleccionado un producto")
            crearNotificacion("No ha seleccionado un producto");
            document.getElementById("cantidadproductos"+idNumero).value="";
        }else{
            // Si no hay una cantidad en el input
            if(!cantidad){
                // alert("No ha ingresado la cantidad");
                crearNotificacion("No ha ingresado la cantidad");
            }
        }
            
        // Si la cantidad es menor a 1
        if(cantidad<1){
            // alert("La cantidad no puede ser 0");
            crearNotificacion("La cantidad no puede ser 0");
            document.getElementById("cantidadproductos"+idNumero).value=1;
        }else{
            // Si todo está cprrecto
            document.getElementById("cantidadproductos"+idNumero).value=cantidad-1;

            // Mandamos el subtotal
            let precioVenta=document.getElementById("precioventaMostrar"+idNumero).value;
            document.getElementById("subtotal"+idNumero).innerHTML=precioVenta*(cantidad-1);

             // Alteramos el total de la factura
             facturaTotal();
        }
    }
        

    // Función para incrementar la cantidad de cada input
    // El parámetro id nos permite acceder a cada elemento de acuerdo a su número de id
    function agregarCantidad(id){
        // console.log(e.target) // Permite acceder al elemento que accionó el click

        // Concatenamos la variable
        cantidadProductos="cantidadproductos"+id;
        
        // Accedemos al valor del input
        campo=parseInt(document.getElementById(cantidadProductos).value);

        // Consultamos si el select está seleccionado
        select="idproductos"+id;
        selectValor=document.getElementById(select).value;

        // Si no está el select seleccionado
        if(!selectValor){
            // alert("No ha seleccionado un producto")
            crearNotificacion("No ha seleccionado un producto");
            document.getElementById(cantidadProductos).value="";
        }else{
            // Si no hay una cantidad en el input
            if(!campo){
                // alert("No ha ingresado la cantidad");
                crearNotificacion("No ha ingresado la cantidad");
            }else{
                // Si todo está correcto
                document.getElementById(cantidadProductos).value=campo+1;

                // Mandamos el subtotal
                let cantidad=document.getElementById("cantidadproductos"+id).value;
                let precioVenta=parseInt(document.getElementById("precioventaMostrar"+id).value);
                let subtotal=document.getElementById("subtotal"+id).innerHTML=precioVenta*cantidad;

                // Aumentaremos el total de la factura
                facturaTotal();
            }
        }
    }

    // Capturamos el evento, y el id (número correspondiente de la fila)
    function sumarCantidad(e, id){

        // ----- ASÍ LO HICE AL PRINCIPIO CON EL EVENTO KEYUP -----//
        // // Valor del input que estamos "modificand"
        // let valor=e.target.value;
        // // Accedemos al precio de venta para calcular el subtotal
        // let subtotal=document.getElementById("precioventaMostrar"+id).value;

        // let operacionSubtotal=subtotal*valor;

        // // Mandamos la información al HTML
        // document.getElementById("subtotal"+id).innerHTML="$"+operacionSubtotal


        // Agregamos el evento input, para que cuando hagamos click sobre las flechas, las reconozca como si estuviesemos sobre el input
        

        // Valor del input que estamos "modificand"
        let valor=e.target.value;

        // Accedemos al precio de venta para calcular el subtotal
        let subtotal=document.getElementById("precioventaMostrar"+id).value;
        let operacionSubtotal=subtotal*valor;

        // Mandamos la información al HTML
        document.getElementById("subtotal"+id).innerHTML=operacionSubtotal
        
        // Alteramos el total de la factura
        facturaTotal();

        };
        

    // Al seleccionar un select, se ejecutará para mostrar los datos del option
    // Con id, recibimos el id del select, en idCantidad recibimos el número de cada id
    function mostrarDatos(id, idCantidad){
        cantidadProductos="cantidadproductos"+idCantidad;

        // Accedemos al valor del select seleccionado
        valorSelect=document.getElementById(id).value;

        // Verificamos si está o no seleccionado, mandamos el id del select y su valor
        verificar=verificarValorSeleccionado(id, valorSelect);

        if (verificar.existe){

            // Este es el select existente
            // console.log("Select que existe es el ", verificar.selectExiste);

            // Accedemos a la cantidad a modificar con su id, numero obtiene sólo el número, ya que selectExiste devuelve el id completo
            numero=verificar.selectExiste.replace(/^\D+/g, '');

            // Obtenemos y modificamos la cantidad del id 
            cantidadModificar=parseInt(document.getElementById("cantidadproductos"+numero).value);
            let operacion=cantidadModificar+1;
            document.getElementById("cantidadproductos"+numero).value=operacion

            // Accedemos al precio de venta para calcular el nuevo subtotal
            let subtotal=document.getElementById("precioventaMostrar"+numero).value;

            let operacionSubtotal=subtotal*operacion;

            // // Mandamos la información al HTML
            document.getElementById("subtotal"+numero).innerHTML=operacionSubtotal

            // Eliminamos la fila recién agregada
            //console.log("Eliminaremos la fila ", idCantidad);
            $('#f'+idCantidad).remove();
           
            // Alteramos el total de la factura
            facturaTotal();

            // alert("Ya está seleccionado")
        }else{
            // Concatenamos y accedemos al valor del input correspondiente
            cantidadProductos="cantidadproductos"+idCantidad;
            document.getElementById(cantidadProductos).value=1;

            // Accedemos al select seleccionado
            opciones=document.getElementById(id);

            // El select reconoce el value seleccionado, también se puede mediante selectedIndex.value
            // valorSelect=document.getElementById(id).value;
            // alert(valorSelect)

            // Accedemos a las opciones del select seleccionada
            precio=opciones.options[opciones.selectedIndex];

            // Capturamos los valores de los data
            let precioCompra=precio.dataset.preciocompra;
            let precioVenta=precio.dataset.precioventa;
            let unidadesMaximas=precio.dataset.unidadesmaximas;

            // Alteramos la cantidad máxima de la opción 
            maximoAlterar=document.getElementById("cantidadproductos"+idCantidad);
            maximoAlterar.max=unidadesMaximas;


            // Los mandamos a los respectivos inputs, mostrar es el input disabled, por lo tanto el valor no se captura
            document.getElementById("precioventaMostrar"+idCantidad).value=precioVenta;
            
            // Estos son los valores que se envian con input tipo hidden
            document.getElementById("precioventa"+idCantidad).value=precioVenta; 
            document.getElementById("preciocompra"+idCantidad).value=precioCompra;

            // Mandamos el subtotal
            let subtotal=document.getElementById("subtotal"+idCantidad).innerHTML=precioVenta;

            // Alteramos el total de la factura
            facturaTotal();

            // alert("No está seleccionado")
        }
    }

    // Función para verificar si un valor ya está seleccionado en otro select, recibimos el id del select y el valor que ya está seleccionado
    function verificarValorSeleccionado(selectId, valorSeleccionado){

        // Aquí se obtiene todo el elemento select como un objeto, es decir, podeoms acceder a sus porpiedades
        var selects = document.getElementsByTagName('select');

        for (var i=0; i<selects.length; i++) {
            if(selects[i].id != selectId){ // Evita comparar el mismo select
                if (selects[i].value == valorSeleccionado){
                    // return true; // El valor ya está seleccionado en otro select
                    return {existe: true, selectExiste: selects[i].id} // Con i capturamos el id donde existe, y enviamos el id completo
                }
            }
        }
        return false; // El valor no está seleccionado en ningún otro select
    }


    // c=2; // Es el contador de cada fila, para asignar id en incremento en cada select respectivamente
    // f=1; // Reconoce el número de selects ingresados, para el ciclo for de fetch

    const rutProveedor=document.getElementById('proveedor');
    rutProveedor.addEventListener('change', getProductos);

    function getProductos(){
        var proveedor=rutProveedor.value;
        var url="entradas/loadselect.php";
        var formData= new FormData();
        formData.append('idproveedor', proveedor);
        
        fetch(url, {
            method: "POST",
            body: formData
        }).then(response=>response.json()) 
        .then(data =>{
            for (let i=1; i<=f; i++){

                // Se valida que encuentre el elemento
                if(document.getElementById("idproductos"+i)){
                var content=document.getElementById("idproductos"+i);
                content.innerHTML=data;
                }
            }
        }).catch(err=>console.log(err))
    }

    function agregar(){
        // Validamos si ya hay un proveedor seleccionado
        let proveedor=rutProveedor.value;

        if(!proveedor){
            // alert("No ha seleccionado un proveedor aún");
            crearNotificacion("No ha seleccionado un proveedor aún");
        }else{

        idcantidadproducto=document.getElementById('idproductos'+c);
        console.log(idcantidadproducto)
        if(idcantidadproducto==null){
            
            $('#content').append("\
                <tr id='f"+c+"'>\
                    <td>"+c+"</td>\
                    <td><select class='ui fluid search dropdown' name='idproductos[]' id='idproductos"+c+"' onchange='mostrarDatos(id, "+c+")' required>\
                        <option value=''>Seleccione el producto</option></td>\
                     <td><input type='number' name='cantidadproductos[]' id='cantidadproductos"+c+"' min='1' oninput='sumarCantidad(event, "+c+")' required></td>\
                    <td><input type='number' name='' id='precioventaMostrar"+c+"' disabled><input type='hidden' name='preciocompra[]' id='preciocompra"+c+"'><input type='hidden' name='precioventa[]' id='precioventa"+c+"'></td>\
                    <td>$<span id='subtotal"+c+"'>0</span></td>\
                    <td><button type='button' class='ui basic button' onclick='agregarCantidad("+c+")'><i class='bx bx-plus colorverde'></i></button></td>\
                    <td><button type='button' class='ui basic button' onclick='restarCantidad("+c+")'><i class='bx bx-minus colorrojo'></i></button></td>\
                    <td><button type='button' class='ui button' onclick='removerFila("+c+")'><i class='bx bx-trash'></i></button></td>\
                </tr>\
            ");

        const rutProveedor=document.getElementById('proveedor');
        proveedor=rutProveedor.value;
        var url="entradas/loadselect.php";
        let idproductos="idproductos"+c;
        var content=document.getElementById(idproductos);
        var formData= new FormData();
        formData.append('idproveedor', proveedor);
        
        fetch("entradas/loadselect.php", {
            method: "POST",
            body: formData
        }).then(response=>response.json())
        .then(data =>{
            content.innerHTML=data;
        }).catch(err=>console.log(err))
            c=c+1;
            f=f+1;
         }
        }
    }

    function removerFila(idFila){
        var selects = document.getElementsByTagName('select');
        if(selects.length<=2){
            crearNotificacion("Debe registrar mínimo un producto");
            // alert("Debe registrar mínimo un producto");
        }else{
            // Recibimos el id de la fila a remover
            $('#f'+idFila).remove();

            // Alteramos el total de la factura
            facturaTotal();
        }
    }

</script>

<?php   
 }else{
    echo "<script>window.location='../menu.php'</script>";
 }
 ?>