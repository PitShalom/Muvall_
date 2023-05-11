<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "cadastro";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

/* (mysqli_connect_error()) {
   echo('erro');
} else {
    echo('funfo');
} */

if (!$conexao) {
    die("Erro na conexão: " . mysqli_connect_error());
}

?>