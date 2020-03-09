<?php

require_once "../Controller/consultar.php";

$id_ponto = $_POST['id_ponto'];

// echo json_encode($id_ponto);
// die;

$query = new Consultar();
$query->queryWhere("pontos","id_ponto",$id_ponto);
echo json_encode( mysqli_fetch_array($query->resultado()) );