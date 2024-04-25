<?php
session_start();
function redirect($url)
{
    ob_start();
    header('Location:' . $url);
    ob_end_flush();
    die();
}
if (!isset($_SESSION['username'])) {
    redirect("./iniciar-sesion.php");
    exit();
}
include_once '../models/consulta.php';
$respuesta=array();
try{
$consulta=new Consulta();
$respuesta['consulta']=$consulta->getReporte();

}catch(PDOException $e){
    $respuesta= $e->getMessage();
}
header('Content-Type: application/json');
$jsonRespuesta = json_encode($respuesta);
echo $jsonRespuesta;

















/* CONSULTAS MEDICAS POR:
SEMANA:
MES:
6MESES:
1AÑO:
/* SELECT CONSULTAS # 

SELECT DATE_FORMAT(fecha, '%d-%m-%Y') AS semana, COUNT(*) AS numero
FROM consulta
WHERE fecha BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE()
GROUP BY YEARWEEK(fecha)
ORDER BY YEARWEEK(fecha) DESC
LIMIT 4;

SELECT 	YEARWEEK(fecha) as semana,count(*) as numero
from consulta
where fecha BETWEEN CURDATE() - INTERVAL 1 month AND CURDATE()
group by YEARWEEK(fecha)
order by YEARWEEK(fecha) DESC LIMIT 4;

update consulta set fecha="2024-04-21" where id=111;
/* POR AÑO
SELECT 	YEAR(fecha) as ano ,count(*) as numero
from consulta
where fecha BETWEEN CURDATE() - INTERVAL 10 year AND CURDATE()
group by YEAR(fecha)
order by YEAR(fecha) desc;
/* POR MESES
SELECT 	YEAR(fecha) as ano, MONTH(fecha) as mes ,count(*) as numero
from consulta
where fecha BETWEEN CURDATE() - INTERVAL 10 year AND CURDATE()
group by MONTH(fecha)
order by YEAR(fecha) desc;

*/

/* MEDICAMENTOS MAS USADOS (#) POR:
MES:
6 MESES:
1 AÑO:
TIPO:
 SELECT MEDICAMENTOS COUNT
SELECT  medicamento.medicamento, COUNT(*) as numero
FROM medicamentoIndicacion 
JOIN receta on medicamentoIndicacion.receta=receta.id
JOIN medicamento on medicamentoIndicacion.medicamento=medicamento.id
JOIN consulta on receta.id=consulta.receta
WHERE consulta.fecha>= DATE_SUB(CURRENT_DATE(), INTERVAL 6 MONTH)
GROUP BY medicamento
ORDER 	BY numero DESC
LIMIT 5;

MEDICAMENTOS POR TIPO:
SELECT MEDICAMENTOS POR TIPO 
SELECT medicamento.tipo, count(*) as numero
FROM medicamentoIndicacion
join medicamento
ON medicamento.id=medicamentoIndicacion.medicamento
join receta 
on receta.id=medicamentoIndicacion.receta
join consulta
on consulta.receta=receta.id
// where fecha>= DATE_SUB(CURRENT_DATE(), INTERVAL 6 MONTH)
group by tipo
order by numero desc;
*/

/*TOP 5 DISEASES:
select enfermedad, count(*) as numero  from antecedentes group by enfermedad order by numero desc limit 5;

select enfermedad from antecedentes join ficha where antecedentes.ficha=ficha.id;

 select fecha from ficha where fecha>= CURDATE() - INTERVAL 6 MONTH;

SELECT enfermedad, COUNT(*) AS numero
FROM antecedentes
JOIN ficha ON antecedentes.ficha = ficha.id
WHERE ficha.fecha >= DATE_SUB(CURRENT_DATE(), INTERVAL 6 MONTH)
GROUP BY enfermedad
ORDER BY numero DESC
LIMIT 5;
 */

/*TERAPIAS MAS USADAS POR:
MES:
6 MESES:
1 AÑO:

SELECT terapia, count(*) as numero
from terapiasAplicadas
join consulta on consulta.id=terapiasAplicadas.consulta
where consulta.fecha>= DATE_SUB(CURRENT_DATE(), INTERVAL 3 MONTH)
group by terapia
order by numero desc
limit 5;

*/




