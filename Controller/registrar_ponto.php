<?php
require_once "conex.php";

class RegistrarPonto{
    public $resultado;
    public $data;
    public $hour;

    public function datanow(){
        $fusohorario = new DateTimeZone("America/Sao_Paulo");
        $data = new DateTime("now", $fusohorario);

        $this->data = $data->format('d/m/Y'); 
        
        return $this->data;
    }
    public function hournow(){
        $fusohorario = new DateTimeZone("America/Sao_Paulo");
        $data = new DateTime("now", $fusohorario);

        $this->hour = $data->format("H:i:s");

        return $this->hour;
    }

    public function ponto($matricula, $data, $hora, $marcacao){
        $conn = new Conex();
        
        $sql = "SELECT * FROM pontos WHERE matricula = '$matricula' and `data_ponto` = '$data'";
        $result = mysqli_query($conn->conexao(), $sql);

        $rowsbd = mysqli_num_rows($result);
        
        $dadosponto = mysqli_fetch_array($result);
        
        // $retorno = ["message"=>"O que tem em maracacao: ".$marcacao,"retorno"=>false];
        // $this->resultado = json_encode($retorno);
        // die;
        
        if($rowsbd == 0){
            $sql = "INSERT INTO `pontos`(`id_ponto`, `matricula`, `entrada`, `intervalo`, `retorno`, `saida`, `data_ponto`) VALUES (NULL,'$matricula','$hora','00:00','00:00','00:00','$data')";
            $result = mysqli_query($conn->conexao(), $sql);

            if($result == true){
                $retorno = ["message"=>"Entrada Registrada","retorno"=>true];
                $this->resultado = json_encode($retorno);
            }
        }else if($rowsbd > 0){
            if($marcacao == "entrada" || $marcacao == "Entrada"){
                $retorno = ["message"=>"Registro de Entrada existente no sistema !","retorno"=>false];
                $this->resultado = json_encode($retorno);
            }
            else if($marcacao == "intervalo" || $marcacao == "Intervalo"){
                
                if($dadosponto['intervalo'] == "00:00"){
                    
                    $sql = "UPDATE `pontos` SET `intervalo` = '$hora' WHERE matricula = '$matricula' and data_ponto = '$data'";
                    $result = mysqli_query($conn->conexao(), $sql);
                    
                    if($result === true){
                        $retorno = ["message"=>"Saida para Intervalo Registrada","retorno"=>true];
                        $this->resultado = json_encode($retorno);
                    }else{
                        $retorno = ["message"=>"Não foi possivel marca saida para Intervalo, por favor entrar em contato com a administração","retorno"=>false];
                        $this->resultado = json_encode($retorno);
                    }
                }else{
                    $retorno = ["message"=>"Saida para Intervalo existente no sistema !","retorno"=>false];
                    $this->resultado = json_encode($retorno);
                }
            }
            else if($marcacao == "retorno" || $marcacao == "Retorno"){
                
                if($dadosponto['retorno'] == "00:00"){
                    
                    $sql = "UPDATE `pontos` SET `retorno` = '$hora' WHERE matricula = '$matricula' and data_ponto = '$data'";
                    $result = mysqli_query($conn->conexao(), $sql);
                    
                    if($result === true){
                        $retorno = ["message"=>"Retorno do Intervalo Registrado","retorno"=>true];
                        $this->resultado = json_encode($retorno);
                    }else{
                        $retorno = ["message"=>"Não foi possivel marca Retorno do Intervalo, por favor entrar em contato com a administração","retorno"=>false];
                        $this->resultado = json_encode($retorno);
                    }
                }else{
                    $retorno = ["message"=>"Retorno do Intervalo existente no sistema !","retorno"=>false];
                    $this->resultado = json_encode($retorno);
                }
            }
            else if($marcacao == "saida" || $marcacao == "Saida"){
                
                if($dadosponto['saida'] == "00:00"){
                    
                    $sql = "UPDATE `pontos` SET `saida` = '$hora' WHERE matricula = '$matricula' and data_ponto = '$data'";
                    $result = mysqli_query($conn->conexao(), $sql);
                    
                    if($result === true){
                        $retorno = ["message"=>"Saida Registrada","retorno"=>true];
                        $this->resultado = json_encode($retorno);
                    }else{
                        $retorno = ["message"=>"Não foi possivel marca Saida, por favor entrar em contato com a administração","retorno"=>false];
                        $this->resultado = json_encode($retorno);
                    }
                }else{
                    $retorno = ["message"=>"Saida existente no sistema !","retorno"=>false];
                    $this->resultado = json_encode($retorno);
                }
            }

        }else{
            $retorno = ["message"=>"Erro !","retorno"=>false];
            $this->resultado = json_encode($retorno);
        }

        mysqli_close($conn->conexao());

    }
    public function resultado(){
        
        return $this->resultado;
    }
}