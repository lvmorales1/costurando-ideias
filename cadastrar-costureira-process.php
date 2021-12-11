<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="pt-br">
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Processa Costureira</title>
</head>

<body>
	<?php
	require_once 'conexao.php';
	//print_r($_POST);exit();
	//print_r($_POST['tserv']); exit;
	$nome = $_POST["nome"];
	$rg = $_POST["rg"];
	$cpf = $_POST["cpf"];
	$rua = $_POST["rua"];
	$numero = $_POST["numero"];
	$cep = $_POST["cep"];
	$municipio = $_POST["cidades"];
	$estado = $_POST["estados"];
	$complemento = $_POST["complemento"];
	$telefone = $_POST["telefone"];
	$celular = $_POST["celular"];
	$sexo = $_POST["sexo"];
	$email = $_POST["email"];
	$senha = $_POST["senha"];

	//echo "$nome,- $rg,- $cep,- $cpf,- $estado, -$municipio";
	//exit();
	$cpfform = formato($cpf);
	//echo"$cpfform";
	//exit;
	//date_default_timezone_set('America/Sao_Paulo');
	//$data_timestamp= strtotime(str_replace('/','-',$data));
	//$data_americana=date("Y/m/d",$data_timestamp);
	//echo"$data_americana";
	//exit();

	?>
	<?php

	function validaCPF($lcpf)
	{


		$ncpf = preg_replace('/[^0-9]/', '', $lcpf);

		if (strlen($ncpf) != 11) {
			return false;
		} else {

			if (preg_match('/(\d)\1{10}/', $ncpf)) {
				return false;
			} else {


				$valid = str_split($ncpf);
				$a = 0;
				$b = 10;
				$c = 0;

				while ($b >= 2) {
					$c += $valid[$a] * $b;
					$a++;
					$b--;
				}
				if ((($c * 10) % (($c * 10) / 11)) != $valid[9]) {
					return false;
				}
				$d = 0;
				$e = 11;
				$f = 0;
				while ($e >= 2) {
					$f += $valid[$d] * $e;
					$d++;
					$e--;
				}
				if ((($f * 10) % (($f * 10) / 11)) != $valid[10]) {
					return false;
				}
			}
			return true;
		}
	}
	?>
	<?php

	function formato($mcpf)
	{
		$ocpf = preg_replace('/[^0-9]/', '', $mcpf);
		if (strlen($ocpf) != 11) {
			return false;
		} else {

			$cpfformatado = substr($ocpf, 0, 3) . '.' .
				substr($ocpf, 3, 3) . '.' .
				substr($ocpf, 6, 3) . '-' .
				substr($ocpf, 9, 2);
			return $cpfformatado;
		}
	}

	//echo $nome $data $cpf $rua $numero $cep $municipio $estado $complemento $obs $telefone $sexo";
	$contanome = strlen($nome);
	$contarg = strlen($rg);
	$contacpf = strlen($cpf);
	$contarua = strlen($rua);
	$contanumero = strlen($numero);
	$contacep = strlen($cep);
	$contacomplemento = strlen($complemento);
	$contatelefone = strlen($telefone);
	$contacelular = strlen($celular);
	$contasexo = strlen($sexo);
	//echo"$contanome";
	//exit();
	if ($contanome > 50) {
		echo "
			<script>
				alert('O nome é muito grande!!');
				window.history.back();
			</script>
			";
	} elseif ($contarg > 14) {
		echo "
				<script>
					alert('O número RG é muito grande!!');
					window.history.back();
				</script>
				";
	} elseif ($contacpf > 14) {
		echo "
				<script>
					alert('O número CPF é inválido!!');
					window.history.back();
				</script>
				";
	} elseif ($contarua > 50) {
		echo "
				<script>
					alert('O nome da rua é muito grande!!');
					window.history.back();
				</script>
				";
	} elseif ($contanumero > 20) {
		echo "
				<script>
					alert('O número da casa é muito grande!!');
					window.history.back();
				</script>
				";
	} elseif ($contacep > 11) {
		echo "
				<script>
					alert('O número do CEP é inválido!!');
					window.history.back();
				</script>
				";
	} elseif ($contacomplemento > 200) {
		echo "
				<script>
					alert('O complemento é muito grande!!');
					window.history.back();
				</script>
				";
	} elseif ($contacelular == 15) {
		echo "
			<script>
				alert('O número de telefone é muito grande!!!');
				window.history.back();
			</script>
			";
	} elseif ($contatelefone > 11) {
		echo "
				<script>
					alert('O número de telefone é muito grande!!');
					window.history.back();
				</script>
				";
	} elseif (validaCPF($cpf) == false) {
		echo "
			<script>
				alert('CPF inválido !');
				window.history.back();
			</script>
			";
	} else {
		$senhas = sha1($senha);
		//$senhas = md5($senha);

		//echo "$nome---$data_americana---$rg---$cpf---$rua---$numero---$cep---$municipio---$estado---$complemento---$obs---$telefone---$sexo";
		//exit;
		require_once "conexao.php";
		$querychecagem = "SELECT nome FROM costureira WHERE cpf = '$cpfform' ";
		$executar = mysqli_query($conexao, $querychecagem);
		$achou = mysqli_num_rows($executar);
		//print_r($querychecagem); exit;
		if ($achou == 0) {

			$querychecaremail = "SELECT nome FROM costureira WHERE email = '$email'";
			$executa = mysqli_query($conexao, $querychecaremail);
			$achouu = mysqli_num_rows($executa);
			//print_r($querychecaremail); exit;	
			if ($achouu == 0) {

				$query = "INSERT INTO costureira (nome,rg,cpf,rua,numero,cep,complemento,telefone,sexo,celular,email,senha, id_estado,id_cidade) 
						VALUES ('$nome','$rg','$cpfform','$rua','$numero','$cep','$complemento','$telefone','$sexo','$celular','$email','$senhas','$estado','$municipio')";
				//print_r($query); exit;

				$inserirservico = mysqli_query($conexao, $query);
				$ultimoid = mysqli_insert_id($conexao);
				//echo "$ultimoid"; exit;
				foreach ($_POST['tserv'] as $tipos_servicos) {
					$queryts = "INSERT INTO servicos (id_costureira, id_tiposervicos) 
								  VALUES ($ultimoid, $tipos_servicos)";
					$inserets = mysqli_query($conexao, $queryts);
				}
				//print_r($tipos_servicos);exit;
				//print_r($queryts); exit;
				//echo"$nome"; exit;
				if ($inserirservico == 1  && $inserets == 1) {
					echo "
					<script>
						alert('$nome cadastrado com sucesso!');
						location='index.php';
					</script>
				";
				} else {
					echo "
					<script>
						alert('Não foi possível efetuar o cadastro, tente novamente!!!');
						window.history.back();
					</script>
				";
				}
			} else {
				echo "
				<script>
					alert('email já está cadastrado(a)!');
					window.history.back();
				</script>
			";
			}
		} else {
			echo "
				<script>
					alert('CPF já está cadastrado(a)!');
					window.history.back();
				</script>
			";
		}
	}


	?>
</body>

</html>