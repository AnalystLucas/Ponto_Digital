<?php
require_once "conex.php";

class CadastrarUser {
    public $resultado;

    public function __construct($matricula, $situacao, $perfil)
    {
        $conn = new Conex();
        $senhahash = password_hash($matricula, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `usuarios`(`id_usuario`, `matricula`, `senha`, `situacao`, `perfil`) VALUES (NULL,'$matricula','$senhahash','$situacao','$perfil')";
        $result = mysqli_query($conn->conexao(), $sql);

        if($result == true){
            $this->resultado = true;
        }else{
            $this->resultado = false;
        }
    }
    public function resultado(){
        return $this->resultado;
    }
}