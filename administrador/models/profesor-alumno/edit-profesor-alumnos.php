<?php

require_once '../../../includes/conexion.php';

if(!empty($_GET)){
    $idprofesoralumno = $_GET['idprofesoralumno'];

    $sql = 'SELECT * FROM profesor_alumno WHERE pa_id = ?';
    $query = $pdo->prepare($sql);
    $query->execute(array($idprofesoralumno));
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if(empty($result)){
        $respuesta = array('status'=> false,'msg'=>'Datos no encontrados');
    } else{
        $respuesta = array('status'=> true,'data'=> $result);
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}