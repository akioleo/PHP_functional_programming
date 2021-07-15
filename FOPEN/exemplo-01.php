<?php

// a+ o conteúdo será presevado, ponteiro direcionado para o final do arquivo e o seguinte será adicionado
$file = fopen("log.txt", "a+");

fwrite($file, date("Y-m-d H:i:s") . "\r\n");

fclose ($file);

echo "Arquivo criado com sucesso!"
// Para pular linha é \r(retorno do ponteiro) e \n (nova linha)
// Tabular (separar as informações) \t, vai separar com tab
//w+ = Write e o "+", como esse arquivo não existe, irá criar um novo
?>

