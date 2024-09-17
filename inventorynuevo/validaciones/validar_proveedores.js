const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
    rut: /^\d{6}$/,
    nombre: /^[a-zA-Z_\-\s]+$/,
    correo: /^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}/,
    telefono: /^\d{10}$/,
}

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "rutnit":
            validarCampo(expresiones.rut, e.target, 'rutnit')
            break;

        case "nombre_pv":
            validarCampo(expresiones.nombre, e.target, 'nombre')
            break;

        case "correo_pv":
            validarCampo(expresiones.correo, e.target, 'correo');
            validarPrecio()
            break;

        case "telefono_pv":
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

inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
})

formulario.addEventListener('submit', (e) => {
    //e.preventDefault();
    formulario.submit()
});