<?php
require_once '../../../includes/conexion.php';

if(!empty($_POST)){
    if(empty($_POST['nombre'])){
        $respuesta = array('status'=>false,'msg' => 'Todos los campos son necesarios');
    } else{
        $idmateria =$_POST['idmateria'];
        $nombre =$_POST['nombre'];
        $estado =$_POST['listEstado'];

        $idmateria = isset($_POST['idmateria']) && $_POST['idmateria'] !== '' ? intval($_POST['idmateria']) : 0;


        $sql = 'SELECT * FROM materias WHERE nombre_materia =? AND materia_id !=? AND estado !=0'; 
        $query = $pdo->prepare($sql);
        $query->execute(array($nombre,$idmateria));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result){
            $respuesta =array('status'=> false,'msg'=>'La materia ya existe');
        }else{
            if($idmateria==0){
                $sqlInsert = 'INSERT INTO materias (nombre_materia,estado) VALUES (?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$estado));
                $accion =1;
            }else{
                $sqlUpdate = 'UPDATE materias SET nombre_materia=?,estado=? WHERE materia_id=?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($nombre,$estado,$idmateria));    
                $accion =2;
                
            }
            

            if($request){
                if($accion==1){
                    $respuesta =array('status'=>true, 'msg'=> 'Materia creada correctamente');
                }else{
                    $respuesta =array('status'=>true, 'msg'=> 'Materia actualizada correctamente');
                }
            }else{
                $respuesta =array('status'=>false, 'msg'=> 'Error al crear materia');
            }   
        }
    
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}