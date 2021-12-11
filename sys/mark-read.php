<?php
	include_once("../lib/includes.php");
	if (isset($_GET['id_pedido'])){

		$idped= $_GET['id_pedido'];
		$idpedido= $_GET['id_pedido'];
		
		if (!empty($_SESSION['id_costureira'])) {
				$idcostu = $_SESSION['id_costureira'];
				$querycidade = " SELECT id_cidade FROM costureira WHERE id_costureira= $idcostu ";
				$mostrar = mysqli_query($conexao, $querycidade);
				while($cidades= mysqli_fetch_array($mostrar)){
				$local = $cidades['id_cidade'];
				}
			if(isset($_SESSION['id_costureira'])){
				$sql3 = "UPDATE pedido INNER JOIN cliente ON cliente.id_cliente = pedido.id_cliente_pedido SET situacao = 1, id_costureira = $_SESSION[id_costureira] WHERE cliente.id_cidade = $local AND id_pedido = $idped";
				$inserir = mysqli_query($conexao, $sql3);
				//echo"$sql3"; exit;
		if ($inserir == 1) {
			echo "
							<script>
								alert('Pedido aceito!');
								location.href='../statuspedidocostureira.php';
							</script>
						";
			} else {
				echo "
						<script>
							alert('Não foi possível aceitar o pedido, tente novamente.');
							history.back();
						</script>
					";
			}
			}
			}
			

	}

?>