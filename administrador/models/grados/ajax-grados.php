<?php
require_once '../../../includes/conexion.php';

if(!empty($_POST)){
    if(empty($_POST['nombre'])){
        $respuesta = array('status'=>false,'msg' => 'Todos los campos son necesarios');
    } else{
        $idgrado =$_POST['idgrado'];
        $nombre =$_POST['nombre'];
        $estado =$_POST['listEstado'];

        $idgrado = isset($_POST['idgrado']) && $_POST['idgrado'] !== '' ? intval($_POST['idgrado']) : 0;


        $sql = 'SELECT * FROM grados WHERE nombre_grado =? AND grado_id !=? AND estado !=0'; 
        $query = $pdo->prepare($sql);
        $query->execute(array($nombre,$idgrado));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result){
            $respuesta =array('status'=> false,'msg'=>'El grado ya existe');
        }else{
            if($idgrado==0){
                $sqlInsert = 'INSERT INTO grados (nombre_grado,estado) VALUES (?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$estado));
                $accion =1;
            }else{
                $sqlUpdate = 'UPDATE grados SET nombre_grado=?,estado=? WHERE grado_id=?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($nombre,$estado,$idgrado));    
                $accion =2;
                
            }
            

            if($request){
                if($accion==1){
                    $respuesta =array('status'=>true, 'msg'=> 'Grado creado correctamente');
                }else{
                    $respuesta =array('status'=>true, 'msg'=> 'Grado actualizado correctamente');
                }
            }else{
                $respuesta =array('status'=>false, 'msg'=> 'Error al crear grado');
            }   
        }
    
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}