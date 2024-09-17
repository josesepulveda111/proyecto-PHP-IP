<?php

if(basename($_SERVER['PHP_SELF'])=="menu.php"){

    // include_once "../menu.php";
    include "conexion.php";
?>
<div class="ui container">
    <br>
    <h1>Productos registrados</h1>
    <br>
    <form class="ui form" action="" method="POST">
        <div class="ten wide field centrarinput">
            <div class="ui icon input">
                <input type="text" placeholder="Buscar..." name="campo" id="campo">
                <i class="bx bx-search icon"></i>
            </div>
        </div>
        <br>
    <!-- </form> -->
        <!-- <div class="ui form"> -->
            <div class="inline field">
                <label for="">Mostrar</label>
                <select class="ui fluid search dropdown" name="num_registros" id="num_registros">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <label class="espacioselect" for="">registros</label>
            </div>
        <!-- </div> -->
    </form>
    <br>
    <table class="ui red table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Precio compra</th>
                <th>Precio venta</th>
                <th>Unidades existentes</th>
                <th>Categoría</th>
                <th>Proveedor</th>
                <th class="cols" colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody id="content">
                <?php  
                mysqli_close($conexion);
                ?>
        </tbody>
    </table>
    <!-- <br> -->
    <div class="ui form">
        <div class="six wide field">
            <label for="" id="lbl-total"></label>
        </div>
        <div class="six wide field" id="nav-paginacion">

        </div>
    </div>
    <br>
</div>
<script>

    let paginaActual=1;

    getData(paginaActual);

    document.getElementById("campo").addEventListener("keyup", function(){
        getData(1)
    }, false)

    document.getElementById("num_registros").addEventListener("change", function(){
        getData(paginaActual)
    }, false)

    function getData(pagina){
        let input=document.getElementById("campo").value;
        let num_registros=document.getElementById("num_registros").value;

        let content=document.getElementById("content");

        if (pagina != null){
            paginaActual=pagina;
        }

        let url="productos/load.php";

        let formaData=new FormData();

        formaData.append('campo', input)
        formaData.append('registros', num_registros)
        formaData.append('pagina', paginaActual)

        fetch(url, {
            method: "POST",
            body: formaData
        }).then(response=>response.json())
        .then(data =>{
            // content.innerHTML=data['data'];
            content.innerHTML=data.data;
            document.getElementById("lbl-total").innerHTML="Mostrando "+data.totalFiltro+" de "+data.totalRegistros+" registros";
            document.getElementById("nav-paginacion").innerHTML=data.paginacion
            // console.log(data);
        }).catch(err=>console.log(err))
    }
</script>
<script src="js/sweetalert2@11.js"></script>
<!-- <script src="js/jquery-3.7.1.min.js"></script> -->
<script>
    
    function borrar(codigo) {
    Swal.fire({
        title: "Desea inhabilitar el producto?",
        text: "El producto pasará a estar inactivo",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        confirmButton: true,
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, seguro",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            mandar_php(codigo)
        }
    });
}

function mandar_php(codigo) {
    parametros={ id: codigo };
    $.ajax({
        data: parametros,
        url: "productos/eliminar.php",
        type: "GET",
        beforeSend: function () {},
        success: function () {
            Swal.fire("Producto inhabilitado", "El producto pasará a estar inactivo", "success").then((result) => {
                window.location.href = "menu.php?mod=consultarproductos"
            })
        }
    })
}

    // function borrar(id){
    //     respuesta=confirm("Está seguro de que desea borrar este producto?");
    //     if (respuesta){ // SI ES TRUE, ENTRA, DE LO CONTRARIO NO
    //         window.location="productos/eliminar.php?id="+id;
    //     }
    // }
</script>

<?php
  
}else{
echo "<script>window.location='../menu.php'</script>";
}
   //include_once "/inventorynuevo/menu/footer.php";
?>