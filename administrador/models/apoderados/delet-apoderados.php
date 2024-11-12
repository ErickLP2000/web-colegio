<?php

require_once '../../../includes/conexion.php';

if($_POST){
    $idapoderado=$_POST['idapoderado'];

    $sql="UPDATE apoderado SET estado =0 WHERE apoderado_id =?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idapoderado));

    if($result){
        $respuesta =array('status'=> true,'msg'=>'Apoderado eliminado correctamente');
    }else{
        $respuesta =array('status'=> false,'msg'=>'Error al eliminar');
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}