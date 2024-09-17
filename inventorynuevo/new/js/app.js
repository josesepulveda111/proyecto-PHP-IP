let list = document.querySelector('.slider-container2 .lista-sliders');
let items = document.querySelectorAll('.slider-container2 .lista-sliders .item');
let punticos = document.querySelectorAll('.slider-container2 .punticos li');
let prev = document.getElementById('prev');
let next = document.getElementById('next');

let active = 0;
let lengthItems = items.length - 1;

next.onclick = function(){
    if(active + 1 > lengthItems){
        active = 0;
    }else{
        active = active + 1;
    }
    reloadSlider();
}

prev.onclick = function(){
    if(active - 1 < 0){
        active = lengthItems;
    }else{
        active = active - 1;
    }
    reloadSlider();
}
let refreshSlider = setInterval(()=>{next.click()}, 4000);
function reloadSlider(){
    let checkleft = items[active].offsetLeft;
    list.style.left = -checkleft + 'px';

    let LastActivePun = document.querySelector('.slider-container2 .punticos li.active');
    LastActivePun.classList.remove('active');
    punticos[active].classList.add('active');
    clearInterval(refreshSlider);
    refreshSlider = setInterval(()=>{next.click()}, 4000);
}
punticos.forEach((li, key) =>{
    li.addEventListener('click', function(){
        active = key;
        reloadSlider();
    })
})