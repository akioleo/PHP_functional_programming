<?php
//OBS: A diferença do FGETS(Irá ler linha por linha) pro FREAD(precisa passar quantos bytes deseja ler do arquivo, exemplo 350b, irá trazer 350 caracteres)

$filename = "usuarios.csv";

//Verificar se o arquivo existe
if (file_exists($filename)) {
    //"r" para ler (read)
    $file = fopen($filename, "r");
    //fgets pega somente a primeira linha do arquivo
    //"implode" pega um array e transforma em string
    //explode toda vez que achar uma vírgula pega uma string e transforma em array
    $headers = explode(",", fgets($file));
    //criar array
    $data = array();

    //Para preencher o array com dados
    //fgets vai tentar ler, caso consiga(possua arquivo), retornará true
    while ($row = fgets($file)) {
        //Onde estão os dados que identifica em array(cada virgula pula uma posição do array)
        $rowData = explode(",", $row);

        //O array de chave-valor
        $linha = array();

        //i começa em zero, vai ser executado enquanto for menor do que o count do headers, e passará de 1 em 1
        for ($i = 0; $i < count($headers); $i++) {
            //Implementação do chave/valor no array $linha
            //vai preencher $linha com o headers do $i atual(começando do zero no for), e adicionando rowData da linha atual
            $linha[$headers[$i]] = $rowData[$i];

        }
        //Adicionar no array $data, o array $linha 
        array_push($data, $linha);
    }
    //o while vai fazer isso linha por linha

    fclose($file);
    echo json_encode($data);
}
?>