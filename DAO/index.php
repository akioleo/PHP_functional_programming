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

//--------------------------------------------------------------------

/*Carrega UM usuário
//Instanciará na variável root a classe Usuario
$root = new Usuario();
//loadbyId é o método criado em Usuario e o parâmetro é o id desejado no banco
$root -> loadbyId(1);
echo $root;
*/

//----------------------------------------------------------------------

/*
//Carrega uma lista de usuários
//Como é um método estático, não precisa instanciar como no exemplo acima, pode chamar direto 
$lista = Usuario :: getList();
echo json_encode($lista);
*/

//-----------------------------------------------------------------------

/*Carrega uma lista de usuários buscando pelo login
//Irá buscar por todos os usuários que começam com "le", imprimirá no caso apenas "leonardo"

$search = Usuario ::search("le");
echo json_encode($search);
*/

//-----------------------------------------------------------------------

/*Carrega um usuário usando login e senha

$usuario = new Usuario();
$usuario -> login("leonardo", "root");
echo $usuario;
*/


?>