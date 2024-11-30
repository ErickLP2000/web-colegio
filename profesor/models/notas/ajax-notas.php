<?php
require_once '../../../includes/conexion.php';

if(!empty($_POST)){
    if(trim($_POST['nota']) == ''){
        $respuesta = array('status'=>false,'msg' => 'Todos los campos son necesarios');
    }else{
        $ideventregada = $_POST['ideventregada'];
        $nota = $_POST['nota'];

        $sqlInsert = 'INSERT INTO notas (ev_entregada_id,valor_nota) VALUES (?,?)';
        $queryInsert = $pdo->prepare($sqlInsert);
        $request = $queryInsert->execute(array($ideventregada, $nota));

        if($request){
            $respuesta = array('status'=>true, 'msg'=> 'Nota cargada correctamente');
        }else{
            $respuesta = array('status'=>false, 'msg'=> 'Error al asignar nota');
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
