<?php 

require_once "../Controller/alterar_dados.php";

$matricula = $_POST['matricula'];
$situacao = $_POST['situacao'];

$alterar = new AlterarDados();

$alterar->updateSituacao($matricula, $situacao);
echo $alterar->resultado();