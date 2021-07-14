<?php


spl_autoload_register(function($class_name){

    $filename = "class" .DIRECTORY_SEPARATOR. $class_name.".php";

    if (file_exists(($filename))) {
        //Tem garantia que o arquivo não será incluído novamente se ele já foi incluído antes
        require_once($filename);

    }

});

?>