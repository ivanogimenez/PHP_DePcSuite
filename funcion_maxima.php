<?php
ini_set("display_errors", 1);
ini_set("display_startup_error", 1);
error_reporting(E_ALL);

function maximo($aVector){
    $valorMaximo = 0;
    foreach ($aVector as $valor) {
        if ($valor > $valorMaximo) {
            $valorMaximo = $valor;
        }
    }
    return $valorMaximo;
}

$aNotas = array(8, 4, 5, 3, 9, 1);
$aSueldo = array(800.30, 400.87, 500.45, 300, 900.70, 900, 1800);

echo"La nota maxima es: " . maximo($aNotas) . "\n";
echo "El sueldo maximo es: " . maximo($aSueldo) . "\n;

?>