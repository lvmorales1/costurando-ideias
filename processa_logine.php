<?php
session_start();
include_once("conexao.php");
$btnLogin = filter_input(INPUT_POST, 'btnLogin', FILTER_SANITIZE_STRING);
if ($btnLogin) {
	$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
	$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
	//echo "$usuario - $senha"; exit;
	if ((!empty($usuario)) and (!empty($senha))) {

		$result_usuario = "SELECT id_entregador, nome, email, senha FROM entregador WHERE email='$usuario' LIMIT 1";
		$resultado_usuario = mysqli_query($conexao, $result_usuario);
		//print_r($result_usuario); exit;
		if ($resultado_usuario) {
			$row_usuario = mysqli_fetch_assoc($resultado_usuario);
			if (sha1($senha) === ($row_usuario['senha'])) {
				$_SESSION['id_entregador'] = $row_usuario['id_entregador'];
				$_SESSION['nome'] = $row_usuario['nome'];
				$_SESSION['email'] = $row_usuario['email'];
				$_SESSION['sexo'] = $row_usuario['sexo'];
				header("Location: index.php");
			} else {
				$_SESSION['msg'] = "Login e/ou senha incorreto!";
				header("Location: login-entregador.php");
			}
		}
	} else {
		$_SESSION['msg'] = "Login e/ou senha incorreto!";
		header("Location: login-entregador.php");
	}
} else {
	$_SESSION['msg'] = "Página não encontrada";
	header("Location: login-entregador.php");
}
