<?php

require_once "conex.php";
require_once "consultar.php";
require_once "cadastrar_user.php";

class Registrar{
    public $resultado;

    public function __construct($name, $user, $sector, $occupation)
    {
        $conn = new Conex();
        $query = new Consultar();
        

        $name = mysqli_real_escape_string($conn->conexao(), $name);
        $user = mysqli_real_escape_string($conn->conexao(), $user);
        $sector = mysqli_real_escape_string($conn->conexao(), $sector);
        $occupation = mysqli_real_escape_string($conn->conexao(), $occupation);
        

        $table = "funcionarios";
        $column = "matricula";
        $field = $user;
        
        $query->queryOne($table, $column, $field);

        if($query->resultado() == false){

            $sql = "INSERT INTO funcionarios (`id_usuario`, `nome`, `matricula`, `setor`, `cargo`) VALUES (NULL,'$name','$user','$sector','$occupation')";
            $result = mysqli_query($conn->conexao(), $sql);
                
            if($result == true){
                $situacao = "Ativo";
                $perfil = "User";

                $cadastrarUser = new CadastrarUser($user, $situacao, $perfil);

                if($cadastrarUser->resultado()){
                    $retorno = ["message"=>"Funcionário Registrado com Sucesso","retorno"=>true];
                    $this->resultado = json_encode($retorno);
                }
            }else{
                $retorno = ["message"=>"Não foi possivel Registrar","retorno"=>false];
                $this->resultado = json_encode($retorno);
            }
        }else{
            $retorno = ["message"=>"Matricula encontra-se registrada","retorno"=>false];
            $this->resultado = json_encode($retorno);
        }
        

    }

    public function resultado(){
        return $this->resultado;
    }
}