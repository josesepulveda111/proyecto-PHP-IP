const formulario = document.getElementById('formulario')
const input1 = document.querySelectorAll('#formulario input')

expresiones = {
    nombre: /^[a-zA-Z_\-\s]+$/
}

const validarFormulario = (e) => {
    if(e.target.name ==="nombre_ct"){
        validarCampo(expresiones.nombre, e.target, 'nombre')
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

input1.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
})

formulario.addEventListener('submit', (e) => {
    //e.preventDefault();
    formulario.submit()
});