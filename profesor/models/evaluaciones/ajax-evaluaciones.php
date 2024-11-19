<?php
require_once '../../../includes/conexion.php';

if(!empty($_POST)){
    if(empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['fecha']) || empty($_POST['valor'])){
        $respuesta = array('status'=>false,'msg' => 'Todos los campos son necesarios');
    }else{
        $idevaluacion =$_POST['idevaluacion'];
        $idcontenido =$_POST['idcontenido'];
        $nombre =$_POST['nombre'];
        $descripcion =$_POST['descripcion'];
        $fecha =$_POST['fecha'];
        $valor =$_POST['valor'];

        $idevaluacion = isset($_POST['idevaluacion']) && $_POST['idevaluacion'] !== '' ? intval($_POST['idevaluacion']) : 0;

        

        
            if($idevaluacion==0){
                $sqlInsert = 'INSERT INTO evaluaciones (nombre_evaluacion,descripcion,fecha,porcentaje,contenido_id) VALUES (?,?,?,?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$descripcion,$fecha,$valor,$idcontenido));
                $accion =1;
            }else{
                $sqlUpdate = 'UPDATE evaluaciones SET nombre_evaluacion=?,descripcion=?,fecha=?,porcentaje=?,contenido_id=? WHERE evaluacion_id=?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($nombre,$descripcion,$fecha,$valor,$idcontenido,$idevaluacion));    
                $accion =2;
                
            }
                
    
                if($request){
                    if($accion==1){
                        $respuesta =array('status'=>true, 'msg'=> 'Evaluación creada correctamente');
                    }else{
                        $respuesta =array('status'=>true, 'msg'=> 'Evaluación actualizada correctamente');
                    }
                }else{
                    $respuesta =array('status'=>false, 'msg'=> 'Error al crear grado');
                }   
            
        
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}