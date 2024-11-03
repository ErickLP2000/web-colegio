<?php
require_once '../../../includes/conexion.php';

if(!empty($_POST)){
    if(empty($_POST['nombre'])){
        $respuesta = array('status'=>false,'msg' => 'Todos los campos son necesarios');
    } else{
        $idactividad =$_POST['idactividad'];
        $nombre =$_POST['nombre'];
        $estado =$_POST['listEstado'];

        $idactividad = isset($_POST['idactividad']) && $_POST['idactividad'] !== '' ? intval($_POST['idactividad']) : 0;


        $sql = 'SELECT * FROM actividad WHERE nombre_actividad =? AND actividad_id !=? AND estado !=0'; 
        $query = $pdo->prepare($sql);
        $query->execute(array($nombre,$idactividad));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result){
            $respuesta =array('status'=> false,'msg'=>'La actividad ya existe');
        }else{
            if($idactividad==0){
                $sqlInsert = 'INSERT INTO actividad (nombre_actividad,estado) VALUES (?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$estado));
                $accion =1;
            }else{
                $sqlUpdate = 'UPDATE actividad SET nombre_actividad=?,estado=? WHERE actividad_id=?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($nombre,$estado,$idactividad));    
                $accion =2;
                
            }
            

            if($request){
                if($accion==1){
                    $respuesta =array('status'=>true, 'msg'=> 'Actividad creada correctamente');
                }else{
                    $respuesta =array('status'=>true, 'msg'=> 'Actividad actualizada correctamente');
                }
            }else{
                $respuesta =array('status'=>false, 'msg'=> 'Error al crear actividad');
            }   
        }
    
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}