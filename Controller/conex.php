<?php
require_once "config.php";

class Conex extends Config{

    public function conexao(){
        $conn = new mysqli($this->host, $this->user, $this->passwd, $this->db);

        if($conn != true){
            return "Erro: ".mysqli_error($conn);
        }else{
            return $conn;
        }
    }
     
}