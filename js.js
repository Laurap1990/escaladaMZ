document.addEventListener('DOMContentLoaded', function(){ //REGISTRAMOS UN EVENT LISTENER. DOMCONTENTLOADED -> QUE HAYA CARGADO HTML, CSS..
    eventListeners();
});


function eventListeners(){
    //creamos un selector de html
    const mobileMenu=document.querySelector('.mobile-menu');

    //PARA QUE CUANDO DEMOS CLICK SE EJECUTE EL CODIGO JS navResponsive
    mobileMenu.addEventListener('click', navResponsive);
}

function navResponsive(){
    //seleccionamos .navegacion
    const navegacion = document.querySelector('.navegacion');

    //si navegación contiene la clase mostrar, la quita con remove
    if(navegacion.classList.contains('mostrar')){
        navegacion.classList.remove('mostrar');
    
    //si no contiene la clase mostrar, la añade. De ese modo al dar click, aparece
    }else{
        navegacion.classList.add('mostrar');
    }

}