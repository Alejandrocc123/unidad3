<?php
function esPar($numero) {
    if ($numero % 2 == 0) {
        return "El número " . $numero . " es par.";
    } else {
        return "El número " . $numero . " es impar.";
    }
}

// Ejemplo de uso
$numeroPrueba = 54;
echo esPar($numeroPrueba);
?>