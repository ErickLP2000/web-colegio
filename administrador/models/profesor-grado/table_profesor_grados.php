<?php
    require_once '../../../includes/conexion.php';

    $sql = 'SELECT * FROM profesor_grado as pg INNER JOIN profesor as p ON pg.profesor_id = p.profesor_id INNER JOIN materias as m ON pg.materia_id = m.materia_id INNER JOIN grados as g ON pg.grado_id = g.grado_id INNER JOIN aulas as a ON pg.aula_id = a.aula_id INNER JOIN periodos as pe ON pg.periodo_id = pe.periodo_id WHERE pg.estadopg !=0';
    $query = $pdo->prepare($sql);
    $query -> execute();
    
    $consulta  = $query-> fetchAll(PDO::FETCH_ASSOC);

    for ($i =0; $i < count($consulta); $i++){ 
        if($consulta[$i]['estadopg'] ==1){
            $consulta[$i]['estadopg'] = '<span class="badge text-bg-success">Activo</span>';
        } else{
            $consulta[$i]['estadopg'] = '<span class="badge text-bg-danger">Inactivo</span>';
        }

        $consulta[$i]['acciones'] = '
            <button class="btn btn-primary" title="Editar" onclick="editarProfesorGrado('.$consulta[$i]['pg_id'].')">Editar</button>
            <button class="btn btn-danger" title="Eliminar" onclick="eliminarProfesorGrado('.$consulta[$i]['pg_id'].')">Eliminar</button>
        ';
    }
    echo json_encode($consulta,JSON_UNESCAPED_UNICODE);