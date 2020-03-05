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
    }
    public function resultado(){
        return $this->resultado;
    }
}
