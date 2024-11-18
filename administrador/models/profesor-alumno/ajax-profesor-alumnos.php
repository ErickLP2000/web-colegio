<?php
require_once '../../../includes/conexion.php';

if(!empty($_POST)){
    if(empty($_POST['listAProfesor']) || empty($_POST['listAlumno']) || empty($_POST['listPeriodo'])){
        $respuesta = array('status'=>false,'msg' => 'Todos los campos son necesarios');
    } else{
        $idprofesoralumno =$_POST['idprofesoralumno'];
        $profesor =$_POST['listAProfesor'];
        $alumno =$_POST['listAlumno'];
        $periodo =$_POST['listPeriodo'];
        $estado =$_POST['listEstado'];

        $idprofesoralumno = isset($_POST['idprofesoralumno']) && $_POST['idprofesoralumno'] !== '' ? intval($_POST['idprofesoralumno']) : 0;

        $sql = 'SELECT * FROM profesor_alumno WHERE alumno_id =? AND pg_id = ? AND periodo_id =? AND pa_id !=? AND estadopa !=0'; 
        $query = $pdo->prepare($sql);
        $query->execute(array($alumno,$profesor,$periodo,$idprofesoralumno));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result){
            $respuesta =array('status'=> false,'msg'=>'El profesor grado ya existe');
        }else{
            if($idprofesoralumno==0){
                $sqlInsert = 'INSERT INTO profesor_alumno (alumno_id,pg_id,periodo_id,estadopa) VALUES (?,?,?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($alumno,$profesor,$periodo,$estado));
                $accion =1;
            }else{
                $sqlUpdate = 'UPDATE profesor_alumno SET alumno_id=?,pg_id=?,periodo_id=?,estadopa=? WHERE pa_id=?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($alumno,$profesor,$periodo,$estado,$idprofesoralumno));
                $accion =2;
            }
            

            if($request){
                if($accion==1){
                    $respuesta =array('status'=>true, 'msg'=> 'Profesor alumno creado correctamente');
                }else{
                    $respuesta =array('status'=>true, 'msg'=> 'Profesor alumno actualizado correctamente');
                }
            }else{
                $respuesta =array('status'=>false, 'msg'=> 'Error al crear profesor alumno');
            }   
        }
    
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}