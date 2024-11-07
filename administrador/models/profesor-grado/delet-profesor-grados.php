<?php

require_once '../../../includes/conexion.php';

if($_POST){
    $idprofesorgrado=$_POST['idprofesorgrado'];

    $sql="UPDATE profesor_grado SET estadopg =0 WHERE pg_id =?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idprofesorgrado));

    if($result){
        $respuesta =array('status'=> true,'msg'=>'Profesor grado eliminado correctamente');
    }else{
        $respuesta =array('status'=> false,'msg'=>'Error al eliminar');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}