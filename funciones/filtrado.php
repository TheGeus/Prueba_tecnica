<?php

function filtrado($datos){
    $datos = trim($datos); //elimina espacios antes y despues
    $datos = stripcslashes($datos); //Devuelve la cadena sin escapar.
    $datos = htmlspecialchars($datos); //Convierte caracteres especiales en entidades HTML
    return $datos;
}