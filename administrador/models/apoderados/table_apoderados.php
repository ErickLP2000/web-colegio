<?php
    require_once '../../../includes/conexion.php';

    $sql = 'SELECT * FROM apoderado WHERE estado !=0';
    $query = $pdo->prepare($sql);
    $query -> execute();
    
    $consulta  = $query-> fetchAll(PDO::FETCH_ASSOC);

    for ($i =0; $i < count($consulta); $i++){ 
        if($consulta[$i]['estado'] ==1){
            $consulta[$i]['estado'] = '<span class="badge text-bg-success">Activo</span>';
        } else{
            $consulta[$i]['estado'] = '<span class="badge text-bg-danger">Inactivo</span>';
        }

        $consulta[$i]['acciones'] = '
            <button class="btn btn-primary" title="Editar" onclick="editarApoderado('.$consulta[$i]['apoderado_id'].')">Editar</button>
            <button class="btn btn-danger" title="Eliminar" onclick="eliminarApoderado('.$consulta[$i]['apoderado_id'].')">Eliminar</button>
        ';
    }
    echo json_encode($consulta,JSON_UNESCAPED_UNICODE);