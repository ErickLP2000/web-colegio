<?php
require_once '../../../includes/conexion.php';

if(!empty($_POST)){
    if(empty($_POST['nombre']) || empty($_POST['edad'])  ||  empty($_POST['direccion']) || empty($_POST['documento']) || empty($_POST['listApoderado']) || empty($_POST['fecha_nac'])){
        $respuesta = array('status'=>false,'msg' => 'Todos los campos son necesarios');
    } else{
        $idalumno =$_POST['idalumno'];
        $nombre =$_POST['nombre'];
        $edad =$_POST['edad'];
        $direccion =$_POST['direccion'];
        $documento =$_POST['documento'];
        $apoderado =$_POST['listApoderado'];
        $fecha_nac =$_POST['fecha_nac'];
        $fecha_reg =$_POST['fecha_reg'];
        $estado =$_POST['listEstado'];

        $idalumno = isset($_POST['idalumno']) && $_POST['idalumno'] !== '' ? intval($_POST['idalumno']) : 0;


        $sql = 'SELECT * FROM alumnos WHERE documento = ? AND apoderado_id =? AND alumno_id !=? AND estado !=0'; 
        $query = $pdo->prepare($sql);
        $query->execute(array($documento,$apoderado,$idalumno));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result){
            $respuesta =array('status'=> false,'msg'=>'El alumno ya existe');
        }else{
            if($idalumno==0){
                $sqlInsert = 'INSERT INTO alumnos (nombre_alumno,edad,direccion,documento,apoderado_id,fecha_nac,fecha_registro,estado) VALUES (?,?,?,?,?,?,?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$edad,$direccion,$documento,$apoderado,$fecha_nac,$fecha_reg,$estado));
                $accion =1;
            }else{
                $sqlUpdate = 'UPDATE alumnos SET nombre_alumno=?,edad=?,direccion=?,documento=?,apoderado_id=?,fecha_nac=?,fecha_registro=?,estado=? WHERE alumno_id=?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($nombre,$edad,$direccion,$documento,$apoderado,$fecha_nac,$fecha_reg,$estado,$idalumno));    
                $accion =2;
                
            }
            

            if($request){
                if($accion==1){
                    $respuesta =array('status'=>true, 'msg'=> 'Alumno creado correctamente');
                }else{
                    $respuesta =array('status'=>true, 'msg'=> 'Alumno actualizado correctamente');
                }
            }else{
                $respuesta =array('status'=>false, 'msg'=> 'Error al crear alumno');
            }   
        }
    
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}