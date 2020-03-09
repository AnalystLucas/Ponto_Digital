<?php
require_once "../Controller/alterar_dados.php";

$entrada = $_POST['entrada'];
$intervalo = $_POST['intervalo'];
$retorno = $_POST['retorno'];
$saida = $_POST['saida'];
$id = $_POST['id_ponto'];

$update = new AlterarDados();

$update->updatePonto($id,$entrada,$intervalo,$retorno,$saida);
echo $update->resultado();

