<?php

require_once "../Controller/login.php";

$matricula = $_POST['matricula'];
$senha = $_POST['senha'];

$login = new Login($matricula, $senha);

$resultado = $login->resultado;

echo $resultado;