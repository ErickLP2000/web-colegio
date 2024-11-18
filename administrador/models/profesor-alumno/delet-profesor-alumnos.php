<?php

require_once '../../../includes/conexion.php';

if($_POST){
    $idprofesoralumno=$_POST['idprofesoralumno'];

    $sql="UPDATE profesor_alumno SET estadopa =0 WHERE pa_id =?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idprofesoralumno));

    if($result){
        $respuesta =array('status'=> true,'msg'=>'Profesor alumno eliminado correctamente');
    }else{
        $respuesta =array('status'=> false,'msg'=>'Error al eliminar');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}