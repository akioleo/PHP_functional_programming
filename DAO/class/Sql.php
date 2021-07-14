<?php

//Classe nossa estendida (irá herdar tudo) do PDO (nativa)
class Sql extends PDO {
    //variável de conexão
    private $connect;
    //Construtor para conectar automaticamente no banco de dados
    public function __construct(){
    //Conexão ao banco
    //Também poderia passar os dados como parâmetros no método construtor (bom para mais servidores, bancos ou usuários)
        $this -> connect = new PDO ("mysql:host=localhost;dbname=dbphp", "root", "");
    }

    private function setParams($statement, $parameters = array()){
        //Um foreach dos parametros, pegando a chave/valor). Utilizávamos ::ID = 2 por exemplo. Este foreach irá percorrer dentro dos parâmetros (pode mandar vários)
        foreach($parameters as $key => $value){
            $this -> setParam($statement, $key, $value);
        }
    }

    //Receberá apenas um parâmetro, com uma chave e um valor
    private function setParam($statement, $key, $value){
        $statement -> bindParam ($key, $value);
    }


    //Este método só faz a query, a execução do comando no banco de dados
    //$params vai ser array que serão nossos dados que vamos receber
    public function execQuery($rawQuery, $params = array()) {
        //$stmt é uma variável comum (não é um objeto) só funciona dentro deste método
        // Como é uma classe estendida do PDO, temos acesso ao "prepare"
        $stmt = $this->connect ->prepare($rawQuery);
        //$stmt é o $rawQuery 
        $this->setParams($stmt, $params);
        $stmt->execute();
        // Irá executar acima normalmente, porém vai retornar o $stmt para ser utilizado no select
        return $stmt;
    }

    //No método query, apenas executa o comando, porém para DELETE, INSERT, não retorna dados. Este método é para o método select específico que é necessário ter um retorno de dados
    public function select($rawQuery, $params = array()):array
    {
        //Irá pegar o retorno do método query ("return $stmt")
        $stmt = $this->execQuery($rawQuery, $params);
        return $stmt -> fetchAll(PDO :: FETCH_ASSOC);

    }

}


?>