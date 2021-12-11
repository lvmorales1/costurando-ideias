<?php
	include_once("../lib/includes.php");
	
	if (isset($_GET['idped_entr'])){
		$idped = $_GET['idped_entr'];
		$identre = $_SESSION['id_entregador'];
			$querycidade = " SELECT id_cidade FROM entregador WHERE id_entregador= $identre ";
			$mostrar = mysqli_query($conexao, $querycidade);
			while($cidades= mysqli_fetch_array($mostrar)){
			$local = $cidades['id_cidade'];
			}
		if(isset($_SESSION['id_entregador'])){
			
			$sql5 ="SELECT pedido.id_costureira AS idcostura, costureira.id_cidade FROM pedido INNER JOIN costureira ON costureira.id_costureira = pedido.id_costureira WHERE costureira.id_cidade =$local ";
			$executas = mysqli_query($conexao, $sql5);
			while($cit = mysqli_fetch_array($executas))
    
			{
				
				$costuraaa = $cit['idcostura'];
						 
			}

			$sql4 = "UPDATE pedido INNER JOIN cliente ON cliente.id_cliente = pedido.id_cliente_pedido SET situacao = 2, id_entregador = $identre WHERE cliente.id_cidade = $local AND id_pedido = $idped ";
			$inserir = mysqli_query($conexao, $sql4);
			//echo"$sql4"; exit;
			if ($inserir == 1) {
				echo "
							<script>
								alert('Pedido aceito!');
								location.href='../statuspedidoentregador.php';
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
?>