<?php

require_once ("config.php");

// Carrega todos os usuários
// $usuarios = $sql->select("SELECT * FROM desenvolvedor");

// Carrega só um usuário de acordo com o ID
//$root = new Usuario();
//$root->loadById(2);

// Carrega todos
//$lista = Usuario::getList();

// Carrega uma lista de usuários buscando pelo login
//$search = Usuario::search("j");

// Carrega um usuário usando o login e a senha
//$usuario = new Usuario();
//$usuario->login("rafa", "123456");
//echo $usuario;

//Cria um novo usuario
// $usuario = new Usuario("cleyton", "senha123");
// $usuario->insert();

$usuario = new Usuario();

// $usuario->loadById(28);

$usuario->update(28, "roro", "2019");

echo $usuario;

?>