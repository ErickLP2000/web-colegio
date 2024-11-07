<?php

require_once '../../../includes/conexion.php';

if(!empty($_GET)){
    $idprofesorgrado = $_GET['idprofesorgrado'];

    $sql = 'SELECT * FROM profesor_grado WHERE pg_id = ?';
    $query = $pdo->prepare($sql);
    $query->execute(array($idprofesorgrado));
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if(empty($result)){
        $respuesta = array('status'=> false,'msg'=>'Datos no encontrados');
    } else{
        $respuesta = array('status'=> true,'data'=> $result);
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}