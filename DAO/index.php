<?php

//Fazer o require_once do arquivo config.php
require_once("config.php");

/* ANTES DO DAO
//a variavel $sql vai receber a classe Sql 
$sql = new Sql();

//Na variável usuários, vai executar pela classe Sql (armazenada na variável sql) o método select
$usuarios = $sql->select("SELECT * FROM usuarios");

echo json_encode($usuarios);
*/

//Instanciará na variável root a classe Usuario
$root = new Usuario();
//loadbyId é o método criado em Usuario e o parâmetro é o id desejado no banco
$root -> loadbyId(1);
echo $root;


?>