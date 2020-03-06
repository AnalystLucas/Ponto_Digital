<?php 

require_once "../../Controller/consultar.php";
require_once "../../Controller/registrar_ponto.php";

$query = new Consultar();
$query->queryRelacional("funcionarios","pontos","nome");
//Como o retorno vem pela mesma função para não da conflito separei os resultado
//resultado_queryr é o retorno da queryRelacional
$resultado_queryr = $query->resultado();

session_start();

if(!isset($_SESSION['logado'])){
  header("location: login.php");
}
$matricula = $_SESSION['matricula'];

$query->queryOne("funcionarios","matricula", $matricula);
//result é o retorno da queryOne 
$result = $query->resultado();
$dadosfunc = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ponto Digital - Registrar Ponto</title>
</head>
<body>
    <form method="POST">
    <select id="opcao">
        <option value="entrada">ENTRADA</option>
        <option value="intervalo">INTERVALO</option>
        <option value="retorno">RETORNO</option>
        <option value="saida">SAIDA</option>
    </select>
    <button id="btn_ponto">Registrar Ponto</button>
    
    </form>
    
    <table>
        <thead>
            <th>Nome</th>
            <th>Entrada</th>
            <th>Intervalo</th>
            <th>Retorno</th>
            <th>Saida</th>
            <th>Data</th>
        </thead>
        <tbody>
            <?php 
            if($resultado_queryr == true){
                while( $dadosponto = mysqli_fetch_array($resultado_queryr) ){?>
            <tr>
                <td><?php echo $dadosponto['nome']; ?> </td>
                <td><?php echo $dadosponto['entrada']; ?></td>
                <td><?php echo $dadosponto['intervalo']; ?></td>
                <td><?php echo $dadosponto['retorno']; ?></td>
                <td><?php echo $dadosponto['saida']; ?></td>
                <td><?php echo $dadosponto['data_ponto']; ?></td>
            </tr>
            <?php }//fim do while
                }//fim do if
            ?>
        </tbody>
    </table>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#btn_ponto").click(function(e){
                e.preventDefault();

                var opcao = $("#opcao").val();

                var select = {
                    select: opcao
                }

                $.ajax({
                    url: "../../Modal/ponto.php",
                    type: "POST",
                    data: select,
                    dataType: 'json',       
                    success:function(resposta){
                        // console.log(resposta);
                        if(resposta.retorno == true){
                            alert(resposta.message);
                            location.reload();
                        }else if(resposta.retorno == false){
                            alert(resposta.message);
                        }
                    }
                });//fim do ajax

            });//fim do click

        }); //fim do ready
    </script>
</body>
</html>