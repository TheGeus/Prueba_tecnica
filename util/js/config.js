function validarEmail(email) {
    let regex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if (regex.test(email)){
        return true;
    }else{
        return false;
    }
}

function validarTelefono(telefono){
    let regex = /(6|7)[0-9]{8}/i;
    if (regex.test(telefono)){
        return true;
    }else{
        return false;
    }
}