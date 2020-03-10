<?php

require_once "../../Controller/consultar.php";
require_once "../../Controller/registrar_ponto.php";

$mesponto = $_POST['messes'];
$matricula = $_POST['funcionario'];

$dataemissao = new RegistrarPonto();

$query = new Consultar();
$query->queryWhere("pontos","matricula",$matricula);

$result = $query->resultado();
$datas = mysqli_fetch_array($query->resultado());

$query->queryWhere("funcionarios","matricula",$matricula);
$dadosfunc = mysqli_fetch_array($query->resultado());

// janeiro,março, maio, julho,agost, outubro, dezembro,
// 01 , 03, 05, 07, 08, 10, 11

$data = $datas['data_ponto'];
$ano = substr($data, 6, 4);
$mes = substr($data, 3, 2);
$meseano = $ano."/".$mes;

$meseano = str_replace("/", "-", $meseano);

$dias = new DateTime($meseano);
$dias = $dias->format("t");

$periodofinal = $dias."/".$mes."/".$ano;
$periodoinicial = "01/".$mes."/".$ano;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ponto Digital - Espelho de Ponto</title>
</head>
<body>
        <table style="width: 100%;" border="2px solid">
            <thead style="border: 2px solid;">
                <tr>
                </tr>

            </thead>
            <tbody>
                <caption style="background-color: black; color: white; font-size: 20px; font-weight: bold; font-family: Arial, Helvetica, sans-serif;">Espelho de Ponto</caption>
                <tr colspan="2">
                    <td>Empregador: Nome da Empresa</td>
                    <td>CNPJ: 30.406.879/0001-00</td>
                </tr>

                <tr colspan="2">
                    <td>Endereço: Rua Endereço da empresa</td>
                    <td>Telefone: (19) 3221-2233</td>
                </tr>
                
                <tr colspan="2">
                    <td>Empregado: <?php echo $dadosfunc['nome']?></td>
                    <td>Matricula: <?php echo $dadosfunc['matricula']?></td>
                </tr>
                
                <tr colspan="2">
                    <td>data admissao: 01/01/2020</td>
                    <td>Data Emissao: <?php echo $dataemissao->datanow(); ?></td>
                </tr>
            </tbody>
        </table>

        <table style="width: 100%;" border="2px solid">
            <thead>
                <tr>
                </tr>

            </thead>
            <tbody>
                <caption style="background-color: black; color: white; font-size: 20px; font-weight: bold; font-family: Arial, Helvetica, sans-serif;">Informações Complementares</caption>
                <tr colspan="3">
                    <td>Periodo Inicial: <?php echo $periodoinicial; ?></td>
                    <td>Periodo Final: <?php echo $periodofinal; ?></td>
                </tr>

                <tr colspan="3">
                    <td>Setor: <?php echo $dadosfunc['setor']?></td>
                    <td>Cargo: <?php echo $dadosfunc['cargo']?></td>
                </tr>

            </tbody>
        </table>
        <table style="width: 100%;" border="2px solid">
            <thead style="border: 2px solid;">
                <tr>
                    <th colspan="1">Data</th>
                    <th colspan="1">Entrada</th>
                    <th colspan="1">Intervalo</th>
                    <th colspan="1">Retorno</th>
                    <th colspan="1">Saida</th>
                    <th colspan="1">Entrada Extra</th>
                    <th colspan="1">Saida Extra</th>
                </tr>   
                

            </thead>
            <tbody>
                <caption style="background-color: black; color: white; font-size: 20px; font-weight: bold; font-family: Arial, Helvetica, sans-serif;">Marcações de Pontos</caption>
                <?php foreach($result as $rowsbd){
                    //passando a possição do array para o 
                    $messes = $rowsbd['data_ponto'];
                    
                    $anoatual = new DateTime();
                    $anoatual = $anoatual->format("Y");

                    //pegando o mes da data do banco
                    $mes = substr($messes, 3, 2);
                    //pegando o ano da data do banco
                    $ano = substr($messes, 6, 4);

                    //verificando se o mês é igual ao mes solicitado
                    if($mes == $mesponto && $ano == $anoatual){
                        
                    
                ?>
                    
                    <tr colspan="1" style="text-align: center;">
                        <td > <?php echo $rowsbd['data_ponto']?> </td>
                        <td > <?php echo $rowsbd['entrada']?> </td>
                        <td > <?php echo $rowsbd['intervalo']?> </td>
                        <td > <?php echo $rowsbd['retorno']?> </td>
                        <td > <?php echo $rowsbd['saida']?> </td>
                        <td > 00:00:00 </td>
                        <td > 00:00:00 </td>
                    </tr>
                <?php 
                        }
                    }
                ?>
            </tbody>
        </table>
</body>
</html>