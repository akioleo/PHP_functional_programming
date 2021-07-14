<?php

$connect = new mysqli ("localhost", "root", "", "dbphp");


if ($connect -> connect_error) {
echo "Error:" . $connect -> connect_error;
}

/*   CADASTRAR USER
$stmt = $connect -> prepare("INSERT INTO usuarios (deslogin, dessenha) VALUES (?, ?)");
$stmt -> bind_param("ss", $login, $pass);

$login = "leonardo";
$pass = "root";
$stmt -> execute();
*/

      //CONSULTAR USUARIOS
$result = $connect -> query ("SELECT * FROM usuarios ORDER BY deslogin");

$data = array();

while ($row = $result -> fetch_array(MYSQLI_ASSOC)){

    array_push($data, $row);
}

echo json_encode($data);


?>