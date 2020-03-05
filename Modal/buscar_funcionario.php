<?php 

require_once "../Controller/consultar.php";

$query = new Consultar();

$id = $_POST['id_funcionario'];

$query->queryWhere("funcionarios","id_funcionario",$id);
$dadosfunc = mysqli_fetch_array($query->resultado());

echo json_encode($dadosfunc);