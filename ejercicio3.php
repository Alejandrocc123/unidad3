<?php
function verificarNumero($numero) {
    if ($numero % 2 == 0) {
        return "El número " . $numero . " es par.";
    } else {
        return "El número " . $numero . " es impar.";
    }
}

$numeroPrueba = 54;
echo verificarNumero($numeroPrueba);
?>