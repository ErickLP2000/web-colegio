<?php
require_once '../../../includes/conexion.php';

if(!empty($_POST)){
    if(empty($_POST['nombre']) || empty($_POST['descripcion'])){
        $respuesta = array('status'=>false,'msg' => 'Todos los campos son necesarios');
    }else{
        $idcontenido =$_POST['idcontenido'];
        $idcurso =$_POST['idcurso'];
        $nombre =$_POST['nombre'];
        $descripcion =$_POST['descripcion'];

        $idcontenido = isset($_POST['idcontenido']) && $_POST['idcontenido'] !== '' ? intval($_POST['idcontenido']) : 0;

        $directorio = '../../../uploads/'.rand(1000,10000);
        
        if(!file_exists($directorio)){
            mkdir($directorio,0777,true);
        }
        
        $material =$_FILES['file']['name'];
        $type =$_FILES['file']['type'];
        $url_temp =$_FILES['file']['tmp_name'];

        $destino = $directorio.'/'.$material;

        $sql = 'SELECT * FROM contenidos WHERE contenido_id =?'; 
        $query = $pdo->prepare($sql);
        $query->execute(array($idcontenido));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($_FILES['file']['size']>15000000){
            $respuesta = array('status' => false,'msg' => 'Solo se premiten archivos hasta 15MB');
        }else{
            if($idcontenido==0){
                $sqlInsert = 'INSERT INTO contenidos (nombre_contenido,descripcion,material,pg_id) VALUES (?,?,?,?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre,$descripcion,$destino,$idcurso));
                    move_uploaded_file($url_temp,$destino);
                $accion =1;
            }else{
                if(empty($_FILES['file']['name'])){
                    $sqlUpdate = 'UPDATE contenidos SET nombre_contenido=?,descripcion=?,pg_id=? WHERE contenido_id=?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre,$descripcion,$idcurso,$idcontenido));    
                    $accion =2;
                }else{
                    $sqlUpdate = 'UPDATE contenidos SET nombre_contenido=?,descripcion=?,material=?,pg_id=? WHERE contenido_id=?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre,$descripcion,$destino,$idcurso,$idcontenido));   
                    if($result['material'] !=''){
                        unlink($result['material']);
                    }
                        move_uploaded_file($url_temp,$destino);
                    $accion =3;
                    
                }
            }
                
    
                if($request){
                    if($accion==1){
                        $respuesta =array('status'=>true, 'msg'=> 'Contenido creado correctamente');
                    }else{
                        $respuesta =array('status'=>true, 'msg'=> 'Contenido actualizado correctamente');
                    }
                }else{
                    $respuesta =array('status'=>false, 'msg'=> 'Error al crear grado');
                }   
            }
        
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}