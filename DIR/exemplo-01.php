<?php

$name = "images";

// CRIANDO DIRETÓRIOS ----------------------------------------
//if "NOT" isdir, ou seja, se não existir um diretório ($name), criar um diretório com o mkdir chamado $name
if (!is_dir($name)) {
    mkdir($name);
    echo "Diretório $name criado com sucesso!";
} else {
    //Se já existir, removê-lo
    rmdir($name);
    echo "Já existe o diretório: $name, foi removido com sucesso";
}

?>

