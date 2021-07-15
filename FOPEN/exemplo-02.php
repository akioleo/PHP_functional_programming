<?php

//No exemplo está puxando do arquivo config.php
require_once ('../dao/class/Sql.php');

$sql = new Sql();

$usuarios = $sql -> select("SELECT * FROM usuarios ORDER BY deslogin");

$headers = array();
// Passar coluna por coluna - CABEÇALHO
foreach($usuarios[0] as $key => $value) {
    //array_push e para adicionar elementos no array. Adicionar no array $headers o valor $key
    //ucfirst é a primeira letra maiúscula
    array_push($headers, ucfirst($key));
}
//csv é um tipo de arquivo que possui delimitador de coluna, no caso ","
//fopen vai abrir o arquivo usuarios.csv ou criar caso ele não exista
$file = fopen("usuarios.csv", "w+");
// implode é qual separador quer colocar entre os elementos(no caso é vírgula), e o segundo é onde deseja aplicar a regra
fwrite($file, implode(",", $headers) . "\r\n");

// DADOS DO BANCO
//Foreach nas linhas, registros
foreach($usuarios as $key => $row) {

    $data = array();
    //foreach nos campos (deslogin, desenha..)
    foreach ($row as $key => $value){
        // Insere os dados em array dentro de outro array ($data)
        array_push($data, $value);
    }//end foreach coluna
    fwrite($file, implode(",", $data) . "\r\n");

}// End foreach de linha

//fechar o arquivo
fclose($file);

?>