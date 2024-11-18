<?php
require_once '../../../includes/conexion.php';

$sql = 'SELECT * FROM profesor_grado as pg INNER JOIN profesor as p ON pg.profesor_id = p.profesor_id INNER JOIN materias as m ON pg.materia_id = m.materia_id INNER JOIN grados as g ON pg.grado_id = g.grado_id INNER JOIN aulas as a ON pg.aula_id = a.aula_id INNER JOIN periodos as pe ON pg.periodo_id = pe.periodo_id WHERE pg.estadopg =1';
$query = $pdo->prepare($sql);
$query->execute();
$data = $query-> fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data,JSON_UNESCAPED_UNICODE);