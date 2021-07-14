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




    //Irá trazer um usuário do ID específico 
    public function loadById($id){
        //Utilizar os dados da classe Sql 
        $sql = new Sql();
        //Vai retornar um resultado apenas pelo fato de ser ID, mesmo assim terá que ser feito um array dentro de outro array
        $results = $sql->select("SELECT * FROM usuarios WHERE idusuario = :ID", array(
            //Chave = valor. 
            //:ID = Identificação do parâmetro = $id
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
//OBS: O IF PODERÁ SER UTILIZADO PELO MÉTODO setDATA, SUBSTITUINDO TUDO POR "$this -> setData($results[0]);"

    // DAO LIST -----------------------------------------------------------------------------------------

    //Trazer uma lista com todos os usuarios da tabela
    //Este método não utilizou a palavra "this" (quando põe this, atribui valor a atributos, métodos, então está "amarrando" à classe), podendo então ser estático
    public static function getList(){
        $sql = new Sql();
        return $sql -> select("SELECT * FROM usuarios ORDER BY deslogin;");

    }
    //Irá buscar por usuários
    //Pegar o que digitar dentro da variável $login, vai colocar a % antes e % depois
    //%% = Não importa se ele começa ou termina com uma letra
    public static function search($login){
        $sql = new Sql();
        return $sql -> select("SELECT * FROM usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
            ':SEARCH' => "%".$login."%"  
        ));
    }

    //Terá que passar login e senha por parâmetro, irá autenticar e ai carregar os dados do usuário
    //Como vai utilizar get/set pra definir o usuário, não pode ser estático
    public function login($login, $password){
        //Utilizar os dados da classe Sql 
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
            //Identificando os parâmetros, se trouxer um usuário, irá pro if e preencher com os set'ters
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));
        //
        if (count($results) > 0) {
            $this -> setData($results[0]);

        }
        else {
            //Estourando erro
            throw new Exception("Login e/ou senha inválidos.");
        }
    }
    
    // Método para o result (SET) --------------------------------------------------------------------------------
    
    //Como está utilizando o código grande várias vezes, a solução é criar um método para enxugar
    public function setData($data){
            $this->setIdusuario($data['idusuario']);
            $this->setDeslogin($data['deslogin']);
            $this->setDessenha($data['dessenha']);
            $this->setDtcadastro(new DateTime($data['datacadastro']));
    }


    // INSERT -----------------------------------------------------------------------------------------------------

    public function insert(){
        $sql = new Sql();

        //Como é MySQL, a chamadaprocedure é CALL e parâmetros entre parênteses, em caso de SQL Server, seria EXECUTE
        $results = $sql -> select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            'LOGIN' => $this -> getDeslogin(),
            ':PASSWORD' => $this -> getDessenha()
        ));
        if(count($results) > 0) {
            $this -> setData($results[0]);
        }
    }

    // CONSTRUTORES --------------------------------------------------------------------------------------------------

    //Irá imprimir em formato json pelos métodos Get
    public function __toString(){
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }

    //Recebe o login e senha pelo construtor
    //Será facilitado no index ao fazer um insert que precisaria deste insert
    //Como foi método construtor com os parâmetros, todo lugar que fosse chamar o Usuario, teria que colocar os parâmetros (login e senha)
    //Como alterativa, colocar as aspas no parâmetro ($login = "") em que torna opcional a passagem de um valor, caso não seja preenchido, será null
    public function __construct($login = "", $password = ""){
            $this -> setDeslogin($login);
            $this -> setDessenha($password);
    }







}
?>
