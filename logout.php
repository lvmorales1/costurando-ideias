<?php


session_start();
session_destroy();
require_once 'conexao.php';

$query = "DELETE FROM carrinho WHERE sessao = '". session_id()."'";
                $exec = mysqli_query($conexao, $query);

header('Location: index.php');
exit;
