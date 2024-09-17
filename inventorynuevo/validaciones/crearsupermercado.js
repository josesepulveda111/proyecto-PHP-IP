const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
    rut: /^\d{6}$/,
    nombre: /^[a-zA-Z_\-\s]+$/,
    direccion: /^[a-zA-Z0-9\s.,#/\-\\]+$/,
    correo: /^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}/,
    telefono: /^\d{10}$/,
}

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "rut_nit":
            validarCampo(expresiones.rut, e.target, 'rut_nit')
            break;

        case "nombre":
            validarCampo(expresiones.nombre, e.target, 'nombre')
            break;

        case "direccion":
            validarCampo(expresiones.direccion, e.target, 'direccion');
            validarPrecio()
            break;

        case "correo":
            validarCampo(expresiones.correo, e.target, 'correo');
            validarPrecio()
            break;
        case "telefono":
            validarCampo(expresiones.telefono, e.target, 'telefono');
            validarPrecio()
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
        formulario.submit();
    }
});