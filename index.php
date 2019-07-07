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
// $usuario = new Usuario();
// $usuario->login("Wendell", "123456");

// echo $usuario;

//inserir usuário novo
// $aluno = new Usuario("Regina","13579");
// $aluno->insert();

// echo $aluno;

//inserir um novo usuário

$usuario = new Usuario();
$usuario->loadById(3);
$usuario->update("vivo", "ahhaha");
echo $usuario;



?>