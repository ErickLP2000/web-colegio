<?php
require_once '../../../includes/conexion.php';

if(!empty($_POST)){
    if(empty($_POST['nombre'])){
        $respuesta = array('status'=>false,'msg' => 'Todos los campos son necesarios');
    } else{
        $idaula =$_POST['idaula'];
        $nombre =$_POST['nombre'];
        $estado =$_POST['listEstado'];

        $idaula = isset($_POST['idaula']) && $_POST['idaula'] !== '' ? intval($_POST['idaula']) : 0;


        $sql = 'SELECT * FROM aulas WHERE nombre_aula =? AND aula_id !=? AND estado !=0'; 
        $query = $pdo->prepare($sql);
        $query->execute(array($nombre,$idaula));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result){
            $respuesta =array('status'=> false,'msg'=>'El grado ya existe');
        }else{
            if($idaula==0){
                $sqlInsert = 'INSERT INTO aulas (nombre_aula,estado) VALUES (?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$estado));
                $accion =1;
            }else{
                $sqlUpdate = 'UPDATE aulas SET nombre_aula=?,estado=? WHERE aula_id=?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($nombre,$estado,$idaula));    
                $accion =2;
                
            }
            

            if($request){
                if($accion==1){
                    $respuesta =array('status'=>true, 'msg'=> 'Aula creado correctamente');
                }else{
                    $respuesta =array('status'=>true, 'msg'=> 'Aula actualizado correctamente');
                }
            }else{
                $respuesta =array('status'=>false, 'msg'=> 'Error al crear aula');
            }   
        }
    
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}