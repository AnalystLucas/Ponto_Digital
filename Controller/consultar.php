<?php
require_once "conex.php";

class Consultar {
    public $resultado;
    
    //Caso queira mudar para private é somente descomentar o codigo a baixo

    // public function setResultado($resultado){
    //     $this->resultado = $resultado;
    // }
    // public function getResultado(){
    //     return $this->resultado;
    // }
    
    //a function recebe 3 parametros, tabela, coluna e campo
    //para comparar apenas com um campo e uma coluna.
    //Informar qual a tabela que vai ser presquisada, qual a coluna da tabela e o campo que vai ser comparada.
    // Exemplo tabela Usuarios quero a coluna matricula e comparar com a recebi atráves do formulário.
    public function queryOne($table, $column, $field)
    {
        $conn = new Conex();
        $sql = "SELECT * FROM $table WHERE $column = '$field'";
        $result = mysqli_query($conn->conexao(), $sql);

        $rowsbd = mysqli_num_rows($result);

        if($rowsbd > 0){
            $this->resultado = $result;
        }else{
            $this->resultado = $result;
        }
        //fechando conexão
        mysqli_close($conn->conexao());
    }
    public function queryTable($table){
        $conn = new Conex();
        $sql = "SELECT * FROM $table";

        $result = mysqli_query($conn->conexao(), $sql);

        $rowsbd = mysqli_num_rows($result);

        if($rowsbd > 0){
            $this->resultado = $result;
        }else{
            $this->resultado = $result;
        }

        //fechando conexão
        mysqli_close($conn->conexao());
    }
    public function queryRelacional($tableOne, $tableTwo, $columnOne){
        //Caso queira consultar campos e tabelas diferentes trazer por relação
        //TableOne é a tabela que você quer buscar 1 campo, para que na relacao seja com os campos entre as Tabelas tragam somente 1 campo da TableOne
        //O columnOne e a coluna que você quer pegar buscar na TableOne  
        $conn = new Conex();
        $sql = "SELECT $tableOne.$columnOne, $tableTwo.* FROM $tableOne, $tableTwo WHERE $tableOne.matricula = $tableTwo.matricula";
        $result = mysqli_query($conn->conexao(), $sql);

        $rowsbd = mysqli_num_rows($result);

        if($rowsbd > 0){
            $this->resultado = $result;
        }else{
            $this->resultado = $result;
        }
        //fechando conexão
        mysqli_close($conn->conexao());
    }
    public function queryWhere($table, $column, $field){
        $conn = new Conex();
        
        $sql = "SELECT * FROM $table WHERE $column = '$field'";
        $result = mysqli_query($conn->conexao(), $sql);

        $rowsbd = mysqli_num_rows($result);

        if($rowsbd > 0){
            $this->resultado = $result;
        }else{
            $this->resultado = $result;
        }
        mysqli_close($conn->conexao());
    }
    
    public function queryTwo($table, $column, $columnTwo, $field, $fieldTwo){
        $conn = new Conex();

        $sql = "SELECT * FROM `$table` WHERE $column = '$field' and $columnTwo = '$fieldTwo'";
        // $sql = "SELECT * FROM $table WHERE $column = '$field'";
        $result = mysqli_query($conn->conexao(), $sql);

        $rowsbd = mysqli_num_rows($result);

        if($rowsbd > 0){
            $this->resultado = $result;
        }else{
            $this->resultado = $result;
        }
        mysqli_close($conn->conexao());
    }

    public function resultado(){
        return $this->resultado;
    }
}