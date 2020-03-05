<?php 

require_once "../Controller/alterar_dados.php";

$id = $_POST['id_funcionario'];
$nome = $_POST['nome'];
$setor = $_POST['setor'];
$cargo = $_POST['cargo'];

$alterar = new AlterarDados();

$alterar->updateFuncionario($id, $nome, $setor, $cargo);
echo $alterar->resultado();