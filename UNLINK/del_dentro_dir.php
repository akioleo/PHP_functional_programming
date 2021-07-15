<?php
//Se images não for um diretório, criar a pasta images
if (!is_dir("images")) mkdir("images");
//scandir lê um diretório e transoforma em array
foreach (scandir("images") as $item) {
    //Não pode conter dentro do array o "." e ".."
    if (!in_array($item, array(".", ".."))) {
        //Apagar arquivo por arquivo pelo foreach $item
        unlink("images/" . $item);
    }
}
echo "OK";
?>