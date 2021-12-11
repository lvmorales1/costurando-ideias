<!DOCTYPE html>
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

	<title>Carrinho</title>
</head>

<body>
	<?php
	require_once 'conexao.php';
	// Iniciamos nossa sessão que vai indicar o usuário pela session_id

	//print_r($_GET['acao']);

	//print_r($_GET['cod']);
	//exit;
	if (isset($_GET['acao'])) {
		$acao = $_GET['acao'];
		$cod =  $_GET['cod'];
	}
	if ($acao != "") {
		// Verificamos se cod do produto é diferente de vazio
		if ($cod != '') {
			// Se for diferente de vazio verificamos se é numérico
			if (is_numeric($cod)) {
				// Tratamos a variavel de caracteres indevidos
				$cod = addslashes(htmlentities($cod));

				// Verificamos se o produto referente ao $cod já está no carrinho para o session id correnpondente
				$query_rs_carrinho = "SELECT id, nome, preco, qtd, sessao FROM carrinho WHERE carrinho.id = '" . $cod . "'  AND carrinho.sessao = '" . session_id() . "'";
				$rs_carrinho = mysqli_query($conexao, $query_rs_carrinho) or die("error");
				$row_rs_carrinho = mysqli_fetch_assoc($rs_carrinho);
				$totalRows_rs_carrinho = mysqli_num_rows($rs_carrinho);
				//print_r($query_rs_carrinho); exit;
				// Se o total for igual a zero é sinal que o produto ainda não está no carrinho
				if ($totalRows_rs_carrinho == 0) {
					// Aqui pegamos os dados do produto a ser incluido no carrinho
					$query_rs_produto = "select id_tiposervico, nome, valor from tipo_servico where id_tiposervico = '" . $cod . "'";
					$rs_produto = mysqli_query($conexao, $query_rs_produto) or die("error");
					$row_rs_produto = mysqli_fetch_assoc($rs_produto);
					$totalRows_rs_produto = mysqli_num_rows($rs_produto);
					//print_r($row_rs_produto); exit;
					//print_r($totalRows_rs_produto ); exit;
					// Se total for maior que zero esse produto existe e então podemos incluir no carrinho
					if ($totalRows_rs_produto > 0) {
						$registro_produto = mysqli_fetch_assoc($rs_produto);
						$id = $row_rs_produto['id_tiposervico'];
						$nome = $row_rs_produto['nome'];
						$preco = $row_rs_produto['valor'];
						//print_r($registro_produto); exit;
						// Incluimos o produto selecionado no carrinho de compras
						$add_sql = ("INSERT INTO carrinho (id, nome, preco, qtd, sessao) 
					VALUES ('$id','$nome','$preco','1','" . session_id() . "')");
						$rs_produto_add = mysqli_query($conexao, $add_sql) or die("error");
						//print_r($add_sql); exit;
					}
				}
			}
		}
	}

	// Verificamos se a acao é igual a excluir
	if ($acao == "excluir") {
		// Verificamos se cod do produto é diferente de vazio
		if ($cod != '') {
			// Se for diferente de vazio verificamos se é numérico
			if (is_numeric($cod)) {
				// Tratamos a variavel de caracteres indevidos
				$cod = addslashes(htmlentities($cod));
				// Verificamos se o produto referente ao $cod  está no carrinho para o session id correnpondente
				$query_rs_car = "SELECT id, nome, preco, qtd, sessao FROM carrinho WHERE id = '" . $cod . "'  AND sessao = '" . session_id() . "'";
				$rs_car = mysqli_query($conexao, $query_rs_car) or die("error");
				$row_rs_carrinho = mysqli_fetch_assoc($rs_car);
				$totalRows_rs_car = mysqli_num_rows($rs_car);
				//print_r($query_rs_car); exit;
				// Se encontrarmos o registro, excluimos do carrinho
				if ($totalRows_rs_car > 0) {
					$sql_carrinho_excluir = "DELETE FROM carrinho WHERE id = '" . $cod . "' AND sessao = '" . session_id() . "'";
					$exec_carrinho_excluir = mysqli_query($conexao, $sql_carrinho_excluir) or die("error");
				}
			}
		}
	}

	// Verificamos se a ação é de modificar a quantidade do produto
	if ($acao == "modifica") {
		$quant = $_POST['qtd'];

		// Se for diferente de vazio verificamos se é numérico
		if (is_array($quant)) {
			// Aqui percorremos o nosso array
			foreach ($quant as $cod => $qtd) {
				// Verificamos se os valores são do tipo numeric
				if (is_numeric($cod) && is_numeric($qtd)) {
					// Fazemos nosso update nas quantidades dos produtos
					$sql_modifica = "UPDATE carrinho SET qtd = '$qtd' WHERE  id = '$cod' AND sessao = '" . session_id() . "'";
					$rs_modifica = mysqli_query($conexao, $sql_modifica) or die("error");
					//print_r($sql_modifica); exit;
				}
			}
		}
	}

	?>

	<nav class="navbar rounded-3 navbar-expand-lg navbar-light " style="background-color:#07f4b0" ;>
		<div class="container-fluid">

			<a class="navbar-brand" href="index.php">
				<img src="img/Costurando Ideias logo.png" width="50" height="50" class=" p-1 d-inline-block align-text-top">
				<a class="navbar-brand fw-bold" href="index.php">Costurando Ideias</a>
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarColor02">
				<ul class="navbar-nav me-2 ms-auto">
					<li class="nav-item">
						<a class="bi bi-house-fill nav-link" href="index.php">&nbsp; Home
							<span class="visually-hidden"></span>
						</a>
					</li>

					<li class="nav-item">
						<?php
						//echo "$_SESSION[id_cliente] $_SESSION[id_costureira] - $_SESSION['id_entregador'] ";
						//exit;
						// $id_cli = $_SESSION['id_cliente'];
						if (isset($_SESSION['id_cliente'])) {
							echo "
                            <li class='nav-item'><a class='active bi bi-cart-fill nav-link' href='carrinho.php'>&nbsp; Carrinho</a></li>
                            <a class='nav-link' href='statuspedidocliente.php'><i class='fas fa-shopping-bag'></i>&nbsp; Meu pedido</a>";
						}
						if (isset($_SESSION['id_costureira'])) {
							echo "<a class='nav-link' href='statuspedidocostureira.php'><i class='fas fa-cut'></i>&nbsp; Meus serviços</a>";
						}
						if (isset($_SESSION['id_entregador'])) {
							echo "<a class='nav-link' href='statuspedidoentregador.php'><i class='fas fa-shipping-fast'></i>&nbsp; Minhas entregas</a>";
						}
						?>
					</li>
					<?php

					if (isset($_SESSION['id_cliente']) &&  isset($_SESSION['nome']) && isset($_SESSION['email'])) {
						echo "
                            <li class='nav-item'>
                                <a class='bi bi-person-fill nav-link' href='perfilc.php'>&nbsp; Perfil</a>
                            </li>
                        ";
					} else if (isset($_SESSION['id_costureira']) &&  isset($_SESSION['nome']) && isset($_SESSION['email'])) {
						echo "
                            <li class='nav-item'>
                                <a class='bi bi-person-fill nav-link' href='perfilcus.php'>&nbsp; Perfil</a>
                            </li>
                        ";
					} else if (isset($_SESSION['id_entregador']) &&  isset($_SESSION['nome']) && isset($_SESSION['email'])) {
						echo "
                            <li class='nav-item'>
                                <a class='bi bi-person-fill nav-link' href='perfile.php'>&nbsp; Perfil</a>
                            </li>
                        ";
					}
					?>
					<li class="nav-item">
						<a class="nav-link" href="sobre.php"><i class="fas fa-info-circle"></i>&nbsp; Sobre nós</a>
					</li>
					<?php
					if (empty($_SESSION['nome']) && empty($_SESSION['email'])) {
						echo "
                        <li class='nav-item dropdown'>
                            <a class='bi bi-arrow-right-square-fill nav-link dropdown-toggle' data-bs-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>&nbsp; Cadastrar</a>
                            <div class='dropdown-menu dropdown-menu-end success'>
                                <a class='dropdown-item' href='cadastrar-usuario.php'><i class='fas fa-user'></i> Cadastrar usuário</a>
                                <a class='dropdown-item' href='cadastrar-costureira.php'><i class='fas fa-cut'></i> Cadastrar costureira</a>
                                <a class='dropdown-item' href='cadastrar-entregador.php'><i class='fas fa-shipping-fast'></i> Cadastrar entregador</a>
                            </div>
                        </li>
						 <li>
                            <a class='bi bi-arrow-right-square-fill nav-link dropdown-toggle' data-bs-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>&nbsp; Login</a>
                            <div class='dropdown-menu dropdown-menu-end success'>
                                <a class='dropdown-item' href='login-usuario.php'><i class='fas fa-user'></i> Sou um cliente</a>
                                <a class='dropdown-item' href='login-costureira.php'><i class='fas fa-cut'></i> Sou uma costureira</a>
                               <a class='dropdown-item' href='login-entregador.php'><i class='fas fa-shipping-fast'></i> Sou um entregador</a>
                            </div>
                        </li>";
					}
					?>
				</ul>
				<?php

				if (isset($_SESSION['nome']) && isset($_SESSION['email'])) {
					echo "
                            <div class='nav-item'>
                                <span class='container-fluid justify-content-end'>
                                    <a class='me-2 btn btn-outline-danger btn-sm' type='button' href='logout.php'><i class='fas fa-sign-out-alt'></i>&nbsp; Sair</a>
                                </span>
                             </div>
                        ";
				}
				?>
			</div>
		</div>
	</nav>

	<div class="m-4 card shadow">
		<table class="table align-center text-center table-hover">
			<form action="carrinho.php?acao=modifica&" method="post">
				<thead class="">
					<th scope="col"><i class="fas fa-tshirt"></i>&nbsp; Produto</th>
					<th scope="col"><i class="fas fa-tags"></i>&nbsp; Valor</th>
					<th scope="col"><i class="fas fa-sort-amount-up-alt"></i>&nbsp; Quantidade</th>
					<th scope="col"><i class="fas fa-coins"></i>&nbsp; Subtotal</th>
					<th scope="col"></th>
				</thead>

				<?php
				require_once 'conexao.php';
				$sql_meu_carrinho = "SELECT id, nome, preco, qtd, sessao FROM carrinho WHERE  sessao = '" . session_id() . "' ORDER BY nome ASC";
				$exec_meu_carrinho =  mysqli_query($conexao, $sql_meu_carrinho) or die("error");
				$qtd_meu_carrinho = mysqli_num_rows($exec_meu_carrinho);
				//print_r($sql_meu_carrinho); exit;
				if ($qtd_meu_carrinho > 0) {
					$soma_carrinho = 0;
					while ($row_rs_produto_carrinho = mysqli_fetch_assoc($exec_meu_carrinho)) {

						//print_r($row_rs_produto_carrinho);exit;
						$soma_carrinho += ($row_rs_produto_carrinho['preco'] * $row_rs_produto_carrinho['qtd']);
				?>
						<tr class="align-center">
							<td scope="row"><?php $nomeprod = utf8_encode($row_rs_produto_carrinho['nome']);
											echo "$nomeprod"; ?></td>
							<td scope="row"><?php $precos = number_format($row_rs_produto_carrinho['preco'], 2, ",", ".");
											echo "R$ $precos"; ?></td>
							<td scope="row">
								<div><input type="number" class="border-0 rounded-pill" size="2" name="qtd[<?= $row_rs_produto_carrinho['id'] ?>]" value="<?php echo "$row_rs_produto_carrinho[qtd]"; ?>" />
							</td>
							<td scope="row">
								<div><?php number_format($totalone = $row_rs_produto_carrinho['preco'] * $row_rs_produto_carrinho['qtd'], 2, ",", ".");
										echo "R$ $totalone"; ?></div>
							</td>
							<td scope="row"><a href="carrinho.php?cod=<?= $row_rs_produto_carrinho['id'] ?>&acao=excluir" id='button' type='submit' class='btn btn-outline-danger'><i class="fas fa-trash-alt"></i>&nbsp; Excluir</a></td>
						</tr>
				<?php
					}
				}
				?>
			</form>
		</table>
		<div class="ms-auto m-4 fs-5"><i class="fas fa-money-bill-wave"></i>&nbsp; Total:&nbsp;<?php $total = number_format($soma_carrinho, 2, ",", ".");;
																								echo "<b>R$ $total</b>"; ?>
			<a href='pagamento.php' id='button' type='submit' class='ms-4 mr-4 btn btn-outline-success'><i class="far fa-credit-card"></i>&nbsp; Pagamento</a>
		</div>
		<hr class="m-4">
		<div class="btn-group mx-auto ms-4 mb-4 justify-content-start">
			<a href='index.php' id='button' type='submit' class='btn btn-outline-warning'><i class='fas fa-chevron-left'></i>&nbsp; Inicio</a>
			<a href='deletecarrinho.php' id='button' type='submit' class='btn btn-outline-primary'><i class="fas fa-backspace"></i>&nbsp; Limpar carrinho</a>
		</div>
</body>

</html>