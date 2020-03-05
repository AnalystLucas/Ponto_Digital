<?php

require_once "conex.php";

Class Login {
    public $resultado;
    public $verificarperfil;

    public function __construct($user, $password)
    {
        //Class conex tem a conexão com o banco
        $conn = new Conex();
        //Passando pelo real escape para trazer somente a string e quebrar qualquer outro codigo colocado dentro dos input's
        $user = mysqli_real_escape_string($conn->conexao(), $user);
        $password = mysqli_real_escape_string($conn->conexao(), $password);

        //sql consulta para verificar o usuário 
        $sql = "SELECT * FROM `usuarios` WHERE matricula = '$user'";
        $result = mysqli_query($conn->conexao(), $sql);
    
        //Pegando as linhas selecionadas do banco
        $rowsbd = mysqli_num_rows($result);
        
        //verificando se ouvi alguma linha selecionada
        if($rowsbd > 0 ){
            $dadosbd = mysqli_fetch_array($result);
            $perfil = $dadosbd['perfil'];
            $senhabd = $dadosbd['senha'];
            $situacao = $dadosbd['situacao'];
            $resultado = [];

            $verificarsenha = password_verify($password ,$senhabd);

            //verificando se ouvi alguma linha selecionada
            if($verificarsenha == true){
                
                //verificando perfil
                if($perfil == "master" || $perfil == "Master"){
                    $this->verificarperfil = true;
                }else{
                    $this->verificarperfil = false;
                }

                //verificando a senha do banco é igual a senha digitada pelo usuário e se esta ativo
                if($verificarsenha == true && $situacao == "ativo" || $situacao == "Ativo"){
                    $resultado = ["message"=>"Acessando o Ponto Digital","perfil"=>$this->verificarperfil,"retorno"=>true];
                    $this->resultado = json_encode($resultado);

                    session_start();
                    
                    $_SESSION['logado'] = true;
                    $_SESSION['matricula'] = $dadosbd['matricula'];

                }else{
                    $resultado = ["message"=>"Não esta disponivel o acesso no momento, verificar com administração","perfil"=>$this->verificarperfil,"retorno"=>false];
                    $this->resultado = json_encode($resultado);
                }
                
            }else{
                $resultado = ["message"=>"Matricula ou Senha Incorreta","perfil"=>$this->verificarperfil,"retorno"=>false];
                $this->resultado = json_encode($resultado);
            }
        }else{
            $resultado = ["message"=>"Nenhum registro localizado","retorno"=>false];
            $this->resultado = json_encode($resultado);
        }

    }
    public function resultado(){
        return $this->resultado;
    }
}