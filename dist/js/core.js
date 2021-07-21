function validarCampos(elementos) {
    let bandera = true;
        
    [...elementos].map( e => {

        if(e.value.trim() == null || e.value.trim() == ''){
            bandera = false
            e.classList.add('campo_vacio')
           let elemento = e.getAttribute('title');
           $.notification.show('error',`${elemento} no puede estar vacío!`);
        }
        else
        {
            e.classList.remove('campo_vacio')
        }

    })

    return bandera

}