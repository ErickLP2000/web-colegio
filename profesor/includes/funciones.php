<?php

$baseDir= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . $baseDir;
define('BASE_URL', $baseUrl);

function promedio($alumno){
    global $pdo;
    $promedio = 0;

    $sqlCantNotas = "SELECT COUNT(valor_nota) as numero FROM notas as n 
        INNER JOIN ev_entregadas as eve ON n.ev_entregada_id = eve.ev_entregada_id 
        WHERE eve.alumno_id = ?";
    $queryCantNotas = $pdo->prepare($sqlCantNotas);
    $queryCantNotas->execute(array($alumno));

    $cantNotas = 0;
    if($row = $queryCantNotas->fetch()){
        $cantNotas = $row['numero'];
    }

    $sqlNotas = "SELECT valor_nota FROM notas as n 
        INNER JOIN ev_entregadas as eve ON n.ev_entregada_id = eve.ev_entregada_id 
        WHERE eve.alumno_id = ?";
    $queryNotas = $pdo->prepare($sqlNotas);
    $queryNotas->execute(array($alumno));

    while($row = $queryNotas->fetch()){
        $promedio += $row['valor_nota'];
    }

    if($cantNotas > 0){
        return $promedio / $cantNotas;
    } else {
        return 0;
    }
}

function formato($cantidad){
    $cantidad = number_format($cantidad, 2, ',', '.');
    return $cantidad;
}

?>
