<?php
require_once '../../../includes/conexion.php';

if(!empty($_POST)){
    if(empty($_POST['nombre']) || empty($_POST['direccion']) || empty($_POST['documento']) || empty($_POST['telefono']) || empty($_POST['correo'])){
        $respuesta = array('status'=>false,'msg' => 'Todos los campos son necesarios');
    } else{
        $idapoderado =$_POST['idapoderado'];
        $nombre =$_POST['nombre'];
        $direccion =$_POST['direccion'];
        $documento =$_POST['documento'];
        $telefono =$_POST['telefono'];
        $correo =$_POST['correo'];
        $estado =$_POST['listEstado'];

        $idapoderado = isset($_POST['idapoderado']) && $_POST['idapoderado'] !== '' ? intval($_POST['idapoderado']) : 0;


        $sql = 'SELECT * FROM apoderado WHERE documento = ? AND apoderado_id !=? AND estado !=0'; 
        $query = $pdo->prepare($sql);
        $query->execute(array($documento,$idapoderado));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result){
            $respuesta =array('status'=> false,'msg'=>'El apoderado ya existe');
        }else{
            if($idapoderado==0){
                $clave = password_hash($_POST['clave'],PASSWORD_DEFAULT);
                $sqlInsert = 'INSERT INTO apoderado (nombre_apoderado,direccion,documento,clave,telefono,correo,estado) VALUES (?,?,?,?,?,?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$direccion,$documento,$clave,$telefono,$correo,$estado));
                $accion =1;
            }else{
                if(empty($_POST['clave'])){
                    $sqlUpdate = 'UPDATE apoderado SET nombre_apoderado=?,direccion=?,documento=?,telefono=?,correo=?,estado=? WHERE apoderado_id=?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre,$direccion,$documento,$telefono,$correo,$estado,$idapoderado));
                    $accion =2;
                }else{
                    $claveUpdate = password_hash($_POST['clave'],PASSWORD_DEFAULT);
                    $sqlUpdate = 'UPDATE apoderado SET nombre_apoderado=?,direccion=?,documento=?,clave=?,telefono=?,correo=?,estado=? WHERE apoderado_id=?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre,$direccion,$documento,$claveUpdate,$telefono,$correo,$estado,$idapoderado));
                    $accion =3;
                }
            }
            

            if($request){
                if($accion==1){
                    $respuesta =array('status'=>true, 'msg'=> 'Apoderado creado correctamente');
                }else{
                    $respuesta =array('status'=>true, 'msg'=> 'Apoderado actualizado correctamente');
                }
            }else{
                $respuesta =array('status'=>false, 'msg'=> 'Error al crear apoderado');
            }   
        }
    
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}