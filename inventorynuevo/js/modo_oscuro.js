const oscuro = document.getElementById('oscuro');

oscuro.addEventListener('click', () => {
    document.body.classList.toggle('dark'); //cambiar el cuerpo del HTML por la clase 'dark'
    oscuro.classList.toggle('active');//cambia el boton y le pone la clase active

    if (document.body.classList.contains('dark')) { //valida si el body tiene la clase dark
        localStorage.setItem('ModoOscuro', 'activo'); //almacena los datos del modo oscuro desde que este activo
        oscuro.classList.remove('bx-toggle-left');
        oscuro.classList.add('bx-toggle-right');
    } else {
        localStorage.setItem('ModoOscuro', 'inactivo'); //almacena los datos del modo oscuro desde que este inactivo
        oscuro.classList.remove('bx-toggle-right');
        oscuro.classList.add('bx-toggle-left');
    }
});

if (localStorage.getItem('ModoOscuro') == 'activo') {
    document.body.classList.toggle('dark');
    oscuro.classList.toggle('active');
    oscuro.classList.remove('bx-toggle-left');
    oscuro.classList.add('bx-toggle-right');
}else {
    document.body.classList.remove('dark');
    oscuro.classList.remove('active');
    oscuro.classList.remove('bx-toggle-right');
    oscuro.classList.add('bx-toggle-left');
}