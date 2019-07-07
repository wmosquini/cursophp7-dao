<?php

require_once("config.php");

$sql = new Usuario();

$sql->loadById(1);
echo $sql;

?>