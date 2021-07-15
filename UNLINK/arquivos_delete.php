<?php
//abrir um arquivo ou criar caso ele nao exista "w+"
$file = fopen("teste.txt", "w+");
fclose($file);
//Irá apagar apenas o arquivo, mantendo a variável
unlink("teste.txt");

echo "Arquivo removido com sucesso!";

?>