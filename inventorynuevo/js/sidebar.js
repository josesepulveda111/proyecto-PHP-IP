// Selecciona todos los elementos de la lista de navegación donde está el submenú
let menuItems = document.querySelectorAll(".nav-links .menu");

// Itera sobre cada elemento de la lista
menuItems.forEach(function(item){

    // Agrega un evento de clic a cada elemento
    item.addEventListener("click", function(event){

        // Verifica si el elemento clicado es parte de un submenú
        let isSubmenuClick = event.target.closest(".sub-menu");

        // Si es parte de un submenú, detener la propagación del evento
        if (isSubmenuClick) {
            event.stopPropagation(); // Esto, es para que interprete que el clic viene de la clase hijo y no de .menu directamente 
            return;
        }

        // Verifica si el elemento ya tiene la clase showMenu
        let isOpen = this.classList.contains("showMenu");

        // Remueve la clase showMenu de todos los elementos
        menuItems.forEach(function(item) {
            item.classList.remove("showMenu");
        });

        // Agrega la clase showMenu solo si no estaba activa previamente
        if (!isOpen) {
            this.classList.add("showMenu");
        }
    });
});

menuItems.forEach(function(item){
    item.addEventListener("click", function(){

        // Removemos la clase active de todos los elementos .iocn-link
        let iconLinks=document.querySelectorAll(".nav-links .iocn-link");
        iconLinks.forEach(function(iconLink){
            iconLink.classList.remove("active");
        });

        // Removemos la clase 'active' de todos los elementos .etiqa
        let etiqaLinks=document.querySelectorAll(".nav-links .etiqa");
        etiqaLinks.forEach(function(etiqaLink) {
            etiqaLink.classList.remove("active");
        });

        // Agregamos la clase 'active' solo al .iocn-link del elemento li clicado
        let iconLink=this.querySelector(".iocn-link");
        if (iconLink){
            iconLink.classList.add("active");
        }
    });
});

// Selecciona todos los elementos a dentro de los submenús
let submenuLinks=document.querySelectorAll(".nav-links .sub-menu li a");

// Agrega un evento de clic a cada elemento
submenuLinks.forEach(function(link) {
    link.addEventListener("click", function(event) {
        // Remueve la clase 'active' de todos los elementos a dentro de los submenús
        submenuLinks.forEach(function(submenuLink) {
            submenuLink.classList.remove("activo");
        });
        // Agrega la clase 'active' solo al elemento clicado
        this.classList.add("activo");
    });
});

// Selecciona todos los elementos a con la clase etiqa dentro de los elementos li con la clase nav-links
let etiqaLinks=document.querySelectorAll(".nav-links li .etiqa");

// Agrega un evento de clic a cada elemento
etiqaLinks.forEach(function(link){
    link.addEventListener("click", function(event){
    
        // Remueve la clase active de todos los elementos con la clase etiqa
        etiqaLinks.forEach(function(etiqaLink){
            etiqaLink.classList.remove("active");
        });

        // Remueve la clase active de todos los elementos .iocn-link
        let iconLinks=document.querySelectorAll(".nav-links .iocn-link");
        iconLinks.forEach(function(iconLink){
            iconLink.classList.remove("active");
        });

        // Agrega la clase active sólo al elemento clicado
        this.classList.add("active");

        let menuItems=document.querySelectorAll(".nav-links .menu");
        menuItems.forEach(function(item){
            if (item.classList.contains("showMenu")){
                item.classList.remove("showMenu");
            }
        });
    });
});

let sidebar=document.querySelector(".sidebar");
let closeBtn=document.querySelector("#btn");
let closeBtnn=document.querySelector("#btnn");

function menuBtnChange() {
    if(sidebar.classList.contains("open")){
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); // Reemplaza los iconos
    }else{
        closeBtn.classList.replace("bx-menu-alt-right","bx-menu"); // Viceversa del paso anterior
    }
}

menuBtnChange(); // Llamo a la función para que se ejecute una vez se cargue el archivo

closeBtnn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close"); // Si está cerrado, lo abre
    sidebar.classList.toggle("open"); // Si está abierto, lo cierra (toggle alterna la clase)
    menuBtnChange();
});

// Son los mismos pasos del proceso anterior, pero se ejecuta una vez se dé clic sobre el botón o sobre el nombre (Inventory)
closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close"); 
    sidebar.classList.toggle("open");
    menuBtnChange();
});