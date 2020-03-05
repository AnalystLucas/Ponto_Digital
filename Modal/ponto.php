<?php
require_once "../Controller/registrar_ponto.php";

session_start();

$opcao = $_POST['select'];

$ponto = new RegistrarPonto();

$data = $ponto->datanow();
$hora = $ponto->hournow();
$matricula = $_SESSION['matricula'];

$ponto->ponto($matricula, $data, $hora, $opcao);

echo $ponto->resultado();