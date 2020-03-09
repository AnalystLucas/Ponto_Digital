<?php 

require_once "conex.php";

class AlterarDados{
    public $resultado;

    public function updateFuncionario($id, $nome, $setor, $cargo){
        $conn = new Conex();

        $id = mysqli_real_escape_string($conn->conexao(), $id);
        $nome = mysqli_real_escape_string($conn->conexao(), $nome);
        $setor = mysqli_real_escape_string($conn->conexao(), $setor);
        $cargo = mysqli_real_escape_string($conn->conexao(), $cargo);

        $sql = "UPDATE funcionarios SET nome = '$nome', setor = '$setor', cargo = '$cargo' WHERE `id_funcionario` = '$id'";
        $result = mysqli_query($conn->conexao(), $sql);

        if($result == true){
            $retorno = ["message"=>"Dados Alterados com Sucesso","retorno"=>true];
            $this->resultado = json_encode($retorno);
        }else{
            $retorno = ["message"=>"Não foi possivel alterar os dados !","retorno"=>false];
            $this->resultado = json_encode($retorno);
        }
        mysqli_close($conn->conexao());
    }
    public function updateSituacao($matricula,$situacao){

        $conn = new Conex();

        $matricula = mysqli_real_escape_string($conn->conexao(), $matricula);
        $situacao = mysqli_real_escape_string($conn->conexao(), $situacao);

        $sql = "UPDATE usuarios SET situacao = '$situacao' WHERE matricula = '$matricula'";
        $result = mysqli_query($conn->conexao(), $sql);

        if($result == true){
            $retorno = ["message"=>"Operação realizada com sucesso !","retorno"=>true];
            $this->resultado = json_encode($retorno);
        }else{
            $retorno = ["message"=>"Não foi possivel realizar a operação !","retorno"=>false];
            $this->resultado = json_encode($retorno);
        }
        mysqli_close($conn->conexao());
    }
    public function updatePonto($id, $field, $fieldTwo, $fieldThree, $fieldFour){
        $conn = new Conex();

        $sql = "UPDATE pontos SET entrada = '$field', intervalo = '$fieldTwo' , retorno = '$fieldThree', saida = '$fieldFour' WHERE id_ponto = '$id'";
        $result = mysqli_query($conn->conexao(), $sql);

        if($result == true){
            $retorno = ["message"=>"Operação realizada com sucesso !","retorno"=>true];
            $this->resultado = json_encode($retorno);
        }else{
            $retorno = ["message"=>"Não foi possivel realizar a operação !","retorno"=>false];
            $this->resultado = json_encode($retorno);
        }
        mysqli_close($conn->conexao());
    }

    public function resultado(){
        return $this->resultado;
    }
}
