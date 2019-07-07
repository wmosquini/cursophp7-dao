<?php

require_once("config.php");


// //carrrga um único usuário específico
// $sql = new Usuario();
// $sql->loadById(1);
// echo $sql;

// //carrega uma lista de usuários
// $lista = Usuario::getList();
// echo json_encode($lista);

//carrega uma lista de usuario que contenha um login
// $search  = Usuario::search("Wendell");
// echo json_encode($search);

//Carrega usuário autenticado
$usuario = new Usuario();
$usuario->login("Wendell", "123456");

echo $usuario;

?>