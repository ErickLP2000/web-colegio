<?php
    require_once '../../../includes/conexion.php';

    $sql = 'SELECT * FROM profesor_alumno as pa INNER JOIN alumnos as a ON pa.alumno_id = a.alumno_id INNER JOIN profesor_grado as pg ON pa.pg_id = pg.pg_id INNER JOIN aulas as au ON pg.aula_id = au.aula_id INNER JOIN materias as m ON pg.materia_id = m.materia_id INNER JOIN periodos as pe ON pa.periodo_id = pe.periodo_id INNER JOIN grados as g ON pg.grado_id = g.grado_id INNER JOIN profesor as p ON pg.profesor_id = p.profesor_id WHERE pa.estadopa !=0';
    $query = $pdo->prepare($sql);
    $query -> execute();
    
    $consulta  = $query-> fetchAll(PDO::FETCH_ASSOC);

    for ($i =0; $i < count($consulta); $i++){ 
        if($consulta[$i]['estadopa'] ==1){
            $consulta[$i]['estadopa'] = '<span class="badge text-bg-success">Activo</span>';
        } else{
            $consulta[$i]['estadopa'] = '<span class="badge text-bg-danger">Inactivo</span>';
        }

        $consulta[$i]['acciones'] = '
            <button class="btn btn-primary" title="Editar" onclick="editarProfesorAlumno('.$consulta[$i]['pa_id'].')">Editar</button>
            <button class="btn btn-danger" title="Eliminar" onclick="eliminarProfesorAlumno('.$consulta[$i]['pa_id'].')">Eliminar</button>
        ';
    }
    echo json_encode($consulta,JSON_UNESCAPED_UNICODE);