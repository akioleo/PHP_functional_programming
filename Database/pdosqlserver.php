<?php

//CONEXÃO COM BANCO
//No SQLServer o pooling é obrigatório, apesar de não ser usado
//É manter o estado da conexão aberta (ConnectionPooling=1) e com Pooling=0 ele fecha, envia dados e fecha a conexão
$connect = new PDO ("sqlsrv:Database=dbphp7;server=localhost\SQLSERVER;ConnectionPooling=0", "sa", "SOFTPROGRAM");




//SELECT
/*$stmt = $connect -> prepare("SELECT * FROM usuarios ORDER BY deslogin;");

$stmt -> execute();

$results = $stmt -> fetchAll(PDO::FETCH_ASSOC);
echo json_encode($results);
*/




/*
//INSERT INTO
$stmt = $connect -> prepare("INSERT INTO usuarios (deslogin, dessenha) VALUES (:LOGIN, :PASSWORD)");

$login = "maria";

$password = "123456";

//Liga o Parâmetro (LOGIN) com esse valor($login)

$stmt ->bindParam(":LOGIN", $login);

$stmt ->bindParam(":PASSWORD", $password);

$stmt ->execute();

echo "Ok, dado INSERIDO!";
*/




/*
//UPDATE SET
$stmt = $connect -> prepare ("UPDATE usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID");

$login = "antonio";
$password = "qwerty";
$id = 3;

$stmt -> bindParam(":LOGIN", $login);
$stmt -> bindParam(":PASSWORD", $password);
$stmt -> bindParam(":ID", $id);

$stmt -> execute ();
echo "Ok, dado ALTERADO!"
*/




/*
//DELETE
// UTILIZAR O WHERE PARA ESPECIFICAR ONDE DESEJA EXCLUIR
$stmt = $connect -> prepare ("DELETE FROM usuarios WHERE idusuario = :ID");

$id = 3;

$stmt -> bindParam(":ID", $id);

$stmt -> execute ();
echo "Ok, dado DELETADO!"
*/



/*
//TRANSAÇÃO
//A transação está amarrada à conexão e não ao statement 
//A transação seria um commit ou rollback (confirmar ou cancelar)
$connect -> beginTransaction();
//Colocando a interrogação, irá ser o dado do primeiro item no array (no caso $id), caso tivesse outra interrogação do lado, seria o segundo parâmetro do array
$stmt = $connect -> prepare ("DELETE FROM usuarios WHERE idusuario = ?");

$id = 2;
//O array é um outro método de fazer um "bind"
$stmt -> execute(array($id));
//o rollback significa que ele irá Deletar o dado acima no execute mas irá fazer um rollback
$connect -> rollback();
//$connect -> commit();
echo "Ok, dado DELETADO!";
*/

?>


