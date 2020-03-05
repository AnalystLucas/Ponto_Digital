<?php

require_once "../Controller/registrar.php";

$nome = $_POST['nome'];
$matricula = $_POST['matricula'];
$setor = $_POST['setor'];
$cargo = $_POST['cargo'];

$registrar = new Registrar($nome, $matricula, $setor, $cargo);
$resultado = $registrar->resultado();

echo $resultado;