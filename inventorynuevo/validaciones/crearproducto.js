const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
    codigo: /^\d{5}$/,
    nombre: /^[a-zA-Z\_\-]+$/,
    precio_compra: /^[1-9]\d*(\.\d+)?$/,
    precio_venta: /^[1-9]\d*(\.\d+)?$/,
    unidades_minimas: /^[1-9]\d*$/,
    unidades_maximas: /^[1-9]\d*$/,
    unidades_existentes: /^[1-9]\d*$/,
}

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "cod_producto":
            validarCampo(expresiones.codigo, e.target, 'codigo')
            break;

        case "nombre_pd":
            validarCampo(expresiones.nombre, e.target, 'nombre')
            break;

        case "precio_compra":
            validarCampo(expresiones.precio_compra, e.target, 'pc');
            validarPrecio()
            break;

        case "precio_venta":
            validarCampo(expresiones.precio_venta, e.target, 'venta');
            validarPrecio()
            break;

        case "unidades_minimas":
            validarCampo(expresiones.unidades_minimas, e.target, 'min')
            validarUnidades()
            break;

        case "unidades_maximas":
            validarCampo(expresiones.unidades_maximas, e.target, 'max')
            validarUnidades()
            break;

        case "unidades_existentes":
            validarCampo(expresiones.unidades_existentes, e.target, 'exi')
            validarUnidades()
            break;
    }
}

const validarCampo = (expresion, input, campo) => {
    if (expresion.test(input.value)) {
        document.getElementById(`grupo_${campo}`).classList.remove('grupo-incorrecto');
        document.getElementById(`grupo_${campo}`).classList.add('grupo-correcto');
        document.querySelector(`#grupo_${campo} .error`).classList.remove('error-activo');
    } else {
        document.getElementById(`grupo_${campo}`).classList.add('grupo-incorrecto');
        document.getElementById(`grupo_${campo}`).classList.remove('grupo-correcto');
        document.querySelector(`#grupo_${campo} .error`).classList.add('error-activo');
    }
}

const validarPrecio = () => {
    const inputPrecio_compra = document.getElementById('precio_compra');
    const inputPrecio_venta = document.getElementById('precio_venta');

    if(parseFloat(inputPrecio_venta.value) <= parseFloat(inputPrecio_compra.value)){
        document.getElementById('grupo_venta').classList.add('grupo-incorrecto');
        document.querySelector('#grupo_venta .error').classList.add('error-activo');
    }else{
        document.getElementById('grupo_venta').classList.remove('grupo-incorrecto');
        document.querySelector('#grupo_venta .error').classList.remove('error-activo');
    }
}

const validarUnidades = () => {
    const Unidades_minimas = document.getElementById('unidades_minimas');
    const Unidades_maximas = document.getElementById('unidades_maximas');
    const Unidades_existentes = document.getElementById('unidades_existentes');

    if(parseFloat(Unidades_maximas.value) < parseFloat(Unidades_minimas.value)){
        document.getElementById('grupo_max').classList.add('grupo-incorrecto');
        document.getElementById('grupo_max').classList.remove('grupo-correcto');
        document.querySelector('#grupo_max .error').classList.add('error-activo');
    }else{
        document.getElementById('grupo_max').classList.remove('grupo-incorrecto');
        document.getElementById('grupo_max').classList.add('grupo-correcto');
        document.querySelector('#grupo_max .error').classList.remove('error-activo');
    }

    if(parseFloat(Unidades_existentes.value) > parseFloat(Unidades_maximas.value)){
        document.getElementById('grupo_exi').classList.add('grupo-incorrecto');
        document.getElementById('grupo_exi').classList.remove('grupo-correcto');
        document.querySelector('#grupo_exi .error2').classList.add('error2-activo');
    }else{
        document.getElementById('grupo_exi').classList.remove('grupo-incorrecto');
        document.getElementById('grupo_exi').classList.add('grupo-correcto');
        document.querySelector('#grupo_exi .error2').classList.remove('error2-activo');
    }
}


// Función para guardar los datos ingresados
function guardarDatos() {
    localStorage.Codigo = document.getElementById("codigo").value;
    localStorage.Nombre = document.getElementById("nombre").value;
    localStorage.Precio_compra = document.getElementById("precio_compra").value;
    localStorage.Precio_venta = document.getElementById("precio_venta").value;
    localStorage.Descripcion= document.getElementById("descrip_pd").value;
    localStorage.Rut= document.getElementById("rut").value;
    localStorage.Categoria= document.getElementById("categoria").value;
    localStorage.Unidades_minimas = document.getElementById("unidades_minimas").value;
    localStorage.Unidades_maximas = document.getElementById("unidades_maximas").value;
    localStorage.Unidades_existentes = document.getElementById("unidades_existentes").value;
 }

const hayErrores = () => {
    const errores = document.querySelectorAll('.grupo-incorrecto');
    return errores.length > 0;
}

inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
});

formulario.addEventListener('submit', (e) => {
    validarFormulario(e);

    if (hayErrores()) {
        e.preventDefault();
        // Puedes agregar aquí un mensaje de error o realizar otras acciones necesarias
    }else{
        guardarDatos();
        formulario.submit();
    }
});
