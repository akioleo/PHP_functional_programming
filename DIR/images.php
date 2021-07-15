<?php

//escaenar (ver o que tem dentro) do diretório
//vai retornar um array
$images = scandir("images");
//var_dump($images)
/* O ponto significa a navegação no diretório na rota
array(5) {
    [0]=>
    string(1) "."
    [1]=>
    string(2) ".."
    [2]=>
    string(12) "css logo.svg"
    [3]=>
    string(13) "logo html.svg"
    [4]=>
    string(12) "php logo.svg"
  }
*/
$data = array();
//img é o nome dado (no caso img porque e uma imagem)
foreach ($images as $img) {
    //in_array faz uma busca dentro de um array
    //Se não existir o ".", ou ".." neste array, seguir o if
    if (!in_array($img, array(".", ".."))){
        //Nome do arquivo "images" ($images é o array) com nome do arquivo $img
        $filename = "images".DIRECTORY_SEPARATOR.$img;
        //retorna um array com informações sobre o caminho em path e o nome do arquivo $filename
        $info = pathinfo($filename);
        //Adionando chaves para o array $info
        $info["size"] = filesize($filename);
        //Data da última modificação do arquivo
        $info["modified"] = date("d/m/Y H:i:s", filemtime($filename));
        //Acessar o arquivo por essa URL, colocamos o caminho principal, concatenando com o $filename 
        //O replace é a função para trocar a string. Obs: a contrabarra é o escape("ignora" o caractere seguinte), então o uso de duas barras que alterará 
        $info["url"] = "http://localhost/curso_php/DIR/".str_replace("\\", "/", $filename);

        //insere no array $data as informações do outro array $info
        array_push($data, $info);  
        /*  
        dirname = sera o nome do diretório
        basename = o nome da imagem completo
        extension = formato da imagem (svg)
        filename = nome da imagem sem extensão
        */      
    } 
}
echo json_encode($data);


?>