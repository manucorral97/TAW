function confirmarEliminar(e){
    /*Lanzo mensaje de alerta con opcion de cancelar y de seguir*/
    if(confirm("¿Seguro que quiere eliminar?")){
        /*Sigue su flujo normal*/
        return true;
    }else{
        /*Cancelo el evento por defecto que sería ir al archivo*/
        e.preventDefault();
    }
}
/*Se ejecuta cuando pulso cualquier boton con clase de eliminar*/
let linkDelete = document.querySelectorAll(".eliminar");

/*Como hay varios enlaces de eliminar...*/
for (var i = 0; i<linkDelete.length; i++){
    linkDelete[i].addEventListener('click', confirmarEliminar);
}