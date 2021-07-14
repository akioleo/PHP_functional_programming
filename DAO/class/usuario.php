<?php

class Usuario {

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;
    //Depois de declarado os atributos, deve-se fazer o get/set de cada um

    public function getIdusuario(){
        return $this->idusuario;
    }

    public function setIdusuario($value){
        $this->idusuario = $value;
    }

    public function getDeslogin(){
        return $this->deslogin;
    }

    public function setDeslogin($value){
        $this->deslogin = $value;
    }

    public function getDessenha(){
        return $this->dessenha;
    }

    public function setDessenha($value){
        $this->dessenha = $value;
    }

    public function getDtcadastro(){
        return $this->dtcadastro;
    }

    public function setDtcadastro($value){
        $this->dtcadastro = $value;
    }

    public function loadById($id){
        //Utilizar os dados da classe Sql 
        $sql = new Sql();
        //Vai retornar um resultado apenas pelo fato de ser ID, mesmo assim terá que ser feito um array dentro de outro array
        $results = $sql->select("SELECT * FROM usuarios WHERE idusuario = :ID", array(
            //Chave = valor. 
            //:ID = Identificação do parâmetro
            //$id é o valor
            ":ID"=>$id
        ));
        //Count irá contar todos os valores de um array (no caso $results)
        //$row irá pegar a posição zero e caso tenha mais números, o count irá passando row por row 
        //if(isset(results[0])) - OUTRA MANEIRA DE FAZER
        if (count($results) > 0) {
            //A primeira linha que resultou
            $row = $results[0];
            // passando $row(linha que está atualmente) passando o valor de nesta posição para cada variável, substituindo o $value na function acima
            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            //new DateTime para vir no formato de data
            $this->setDtcadastro(new DateTime($row['dtcadastro']));
        }
    }

    
    //Irá imprimir em formato json pelos métodos Get
    public function __toString(){
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }
}

?>