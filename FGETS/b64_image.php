<?php
//caminho do arquivo
$filename = "logo.png";
//file_get_contents: como se fizesse o fopen, lesse o arquivo inteiro e fizesse fclose
$base64 = base64_encode(file_get_contents($filename));
//ifino é uma classe orientada à objetos que possui funções fileinfo
//Constante que pede o tipo "MIME" do arquivo (Ex: image/png)
$fileinfo = new finfo(FILEINFO_MIME_TYPE);

//$fileinfo é o objeto que criamos utilizando o método "file" passando a referência de onde está o arquivo ($filename)
$mimetype = $fileinfo->file($filename);
//Padrão de exibição base64 dinâmico
//estático echo "data:image/png;base64," . $base64
$base64encode = "data:" . $mimetype . ";base64," . $base64;
//Se passar arquivo do word por exemplo, vai pegar .doc por exemplo
//ABAIXO DO PHP ----------------------------------------------------------------------------------------------
//Criando hiperlink e o href utilizando abreviação "?=?" e dentro, o nome da variável que deseja imprimir 
//TAG de imagem passando a mesma variável
//OBS: Está renderizando a imagem na tela com base64 (convertido de binário) ao invés de imprimir apenas o texto em base64
//data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABVYA…sAgAAAAAkElYBAAAAABL9f53cvkRlVm4kAAAAAElFTkSuQmCC
?>
<a href="<?=$base64encode?>" target="_blank">Link Para Imagem</a>

<img src="<?=$base64encode?>">