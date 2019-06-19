<?php

require_once ("config.php");

// $usuarios = $sql->select("SELECT * FROM desenvolvedor");

$root = new Usuario();

$root->loadById(2);

echo $root;

?>