<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/2e45453992.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="js/script.js"></script>

	<title>Notificações</title>
</head>

<body>
	<?php
	require_once 'conexao.php';
	if (!empty($_SESSION['id_costureira'])) {
		$_GET['id_costureira'] = $_SESSION['id_costureira'];
		$idcostu = $_SESSION['id_costureira'];
		$querycidade = " SELECT id_cidade FROM costureira WHERE id_costureira= $idcostu ";
		$mostrar = mysqli_query($conexao, $querycidade);
		while ($cidades = mysqli_fetch_array($mostrar)) {
			$local = $cidades['id_cidade'];
		}
	}
	if (!empty($_SESSION['id_entregador'])) {
		$_GET['id_entregador'] = $_SESSION['id_entregador'];
		$identre = $_SESSION['id_entregador'];
		$querycidade = " SELECT id_cidade FROM entregador WHERE id_entregador= $identre ";
		$mostrar = mysqli_query($conexao, $querycidade);
		while ($cidades = mysqli_fetch_array($mostrar)) {
			$local = $cidades['id_cidade'];
		}
	}



	//echo  - $_SESSION['id_entregador'], $_GET['id_entregador'] ;exit;

	//echo "$local"; exit;
	//$buscacliente = "SELECT id_cliente FROM cliente WHERE id_cidade = $local";
	//$exibir = mysqli_query($conexao, $buscacliente);
	//$arrycliente = array();
	//$z=0;
	// while($city = mysqli_fetch_array($exibir)){

	// //$arrycliente[$z]=$arrycli;
	//echo"$arrycli"; exit;
	//$z=$z+1;
	//print_r($buscacostureira);
	//print_r($city['id_costureira']);

	//}


	function select_notificaoes($conexao)
	{
		if (!empty($_SESSION['id_costureira'])) {
			$idcostu = $_SESSION['id_costureira'];
			$querycidade = " SELECT id_cidade FROM costureira WHERE id_costureira= $idcostu ";
			$mostrar = mysqli_query($conexao, $querycidade);
			while ($cidades = mysqli_fetch_array($mostrar)) {
				$local = $cidades['id_cidade'];
			}
			$situacao = 0;
			if (isset($_GET['id_costureira'])) {
				$sql = $conexao->prepare("SELECT pedido.id_pedido AS idpedido, pedido.id_cliente_pedido AS idpedidocli, pedido.id_costureira AS idcost, pedido.descricao AS iddesc, pedido.id_entregador AS identrega, cliente.id_cliente AS idcliente, pedido.situacao AS siation, cliente.id_cidade AS idcity FROM cliente INNER JOIN pedido ON cliente.id_cliente = pedido.id_cliente_pedido WHERE cliente.id_cidade = '$local'  AND  id_costureira = 0 AND situacao = ?  ORDER BY id_pedido DESC");
				$sql->bind_param('s', $situacao);
				$sql->execute();
				$get = $sql->get_result();
				$total = $get->num_rows;

				if ($total > 0) {


					while ($dados = $get->fetch_array()) {
						switch ($dados['siation']) {
							case 0:
								$dados['siation'] = "Não Aceito";
								break;

							case 1:
								$dados['siation'] = "Aceito";
								break;
						}
						$iddopedido = $dados['idpedido'];

						echo "
					<form action='sys/mark-read.php' method='get'>
					<tr>
					<table class='table text-center table-hover'>
						<thead>
							<th scope='col'><i class='fas fa-align-left'></i>&nbsp; Descrição do pedido</th>
							<th scope='col'><i class='fas fa-exclamation-circle'></i>&nbsp; Status</th>
							<th scope='col'><i class='fas fa-edit'></i>&nbsp; Atualizar status</th>
						</thead>
						<td scope='row'>{$dados['iddesc']}</td> 
						<td scope='row'>{$dados['siation']}</td>
						<td scope='row'>
							<button type='submit' id='m-read1' class='btn btn-outline-success' name='id_pedido' value='$iddopedido'><i class='fas fa-check-circle'></i>&nbsp; Aceitar pedido</button>
						</td>
					</tr>
					</form>
					";
					}
				}
			}
		}

		if (!empty($_SESSION['id_entregador'])) {
			$identre = $_SESSION['id_entregador'];
			$querycidade = " SELECT id_cidade FROM entregador WHERE id_entregador= $identre ";
			$mostrar = mysqli_query($conexao, $querycidade);
			while ($cidades = mysqli_fetch_array($mostrar)) {
				$local = $cidades['id_cidade'];
			}

			$situacao = 1;
			if (isset($_GET['id_entregador'])) {
				$sql2 = $conexao->prepare("SELECT pedido.id_pedido AS idpedido, pedido.id_cliente_pedido AS idpedidocli,  pedido.descricao AS iddesc, pedido.id_entregador AS identrega, cliente.id_cliente AS idcliente, pedido.situacao AS siation, cliente.id_cidade AS idcity FROM cliente INNER JOIN pedido ON cliente.id_cliente = pedido.id_cliente_pedido WHERE cliente.id_cidade = '$local' AND id_entregador = 0 AND situacao = ?  ORDER BY id_pedido DESC");
				$sql2->bind_param('i', $situacao);
				$sql2->execute();
				$get2 = $sql2->get_result();
				$total2 = $get2->num_rows;

				if ($total2 > 0) {

					while ($dados2 = $get2->fetch_array()) {
						switch ($dados2['siation']) {
							case 1:
								$dados2['siation'] = "Não Aceito";
								break;

							case 2:
								$dados2['siation'] = "Aceito";
								break;
						}

						echo "
						<form action='sys/aceitar-pedido.php' method='get'>
						<table class='table text-center table-hover'>
						<thead>
							<th scope='col'><i class='fas fa-align-left'></i>&nbsp; Descrição do pedido</th>
							<th scope='col'><i class='fas fa-exclamation-circle'></i>&nbsp; Status</th>
							<th scope='col'><i class='fas fa-edit'></i>&nbsp; Atualizar status</th>
						</thead>
						<tr>
							<td scope='row'>{$dados2['iddesc']}</td> 
							<td scope='row'>{$dados2['siation']}</td>
							<td scope='row'>
								<button type='submit' class='btn btn-outline-success' id='acei' name='idped_entr' value='$dados2[idpedido]'><i class='fas fa-check-circle'></i>&nbsp;  Aceitar pedido</button>
							</td>
						</tr>
						</table>
					 </form>
					";
					}
				}
			}
		}
	}














	?>

</body>

</html>