<?php
require_once '../../../includes/conexion.php';

if(!empty($_POST)){
    if(empty($_POST['listProfesor']) || empty($_POST['listGrado']) || empty($_POST['listAula']) || empty($_POST['listPeriodo'])){
        $respuesta = array('status'=>false,'msg' => 'Todos los campos son necesarios');
    } else{
        $idprofesorgrado =$_POST['idprofesorgrado'];
        $profesor =$_POST['listProfesor'];
        $grado =$_POST['listGrado'];
        $aula =$_POST['listAula'];
        $periodo =$_POST['listPeriodo'];
        $estado =$_POST['listEstado'];

        $idprofesorgrado = isset($_POST['idprofesorgrado']) && $_POST['idprofesorgrado'] !== '' ? intval($_POST['idprofesorgrado']) : 0;


        $sql = 'SELECT * FROM profesor_grado WHERE profesor_id = ? AND grado_id =? AND aula_id =? AND periodo_id =? AND pg_id !=? AND estadopg !=0'; 
        $query = $pdo->prepare($sql);
        $query->execute(array($profesor,$grado,$aula,$periodo,$idprofesorgrado));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result){
            $respuesta =array('status'=> false,'msg'=>'El profesor grado ya existe');
        }else{
            if($idprofesorgrado==0){
                $sqlInsert = 'INSERT INTO profesor_grado (profesor_id,grado_id,aula_id,periodo_id,estadopg) VALUES (?,?,?,?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($profesor,$grado,$aula,$periodo,$estado));
                $accion =1;
            }else{
                $sqlUpdate = 'UPDATE profesor_grado SET profesor_id=?,grado_id=?,aula_id=?,periodo_id=?,estadopg=? WHERE pg_id=?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($profesor,$grado,$aula,$periodo,$estado,$idprofesorgrado));
                $accion =2;
            }
            

            if($request){
                if($accion==1){
                    $respuesta =array('status'=>true, 'msg'=> 'Profesor grado creado correctamente');
                }else{
                    $respuesta =array('status'=>true, 'msg'=> 'Profesor grado actualizado correctamente');
                }
            }else{
                $respuesta =array('status'=>false, 'msg'=> 'Error al crear profesor grado');
            }   
        }
    
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}