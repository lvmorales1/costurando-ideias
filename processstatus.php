<?php
require_once 'conexao.php';

if (isset($_SESSION['id_entregador'])) {
	$identregador = $_SESSION['id_entregador'];
	$id_pedido = $_POST['id_pedido'];
	$id_status = $_POST['situ'];
	$idnovostatus = $_POST['novositu'];


	$query = "UPDATE pedido SET situacao = $idnovostatus  WHERE id_pedido = $id_pedido";
	$inserir = mysqli_query($conexao, $query);
	//echo"$query ----$identregador"; exit;
	if ($inserir == 1) {
		echo "
							<script>
								alert('Status atualizado!');
								location.href='statuspedidoentregador.php';
							</script>
						";
	} else {
		echo "
						<script>
							alert('Não foi possível atualizar o status, tente novamente.');
							location.href='statuspedidoentregador.php';
						</script>
					";
	}
}
if (isset($_SESSION['id_costureira'])) {
	$idcostura = $_SESSION['id_costureira'];
	$id_pedido = $_POST['id_pedido'];
	$id_status = $_POST['situ'];
	$idnovostatus = $_POST['novositu'];
	$query = "UPDATE pedido SET situacao = $idnovostatus  WHERE id_pedido = $id_pedido";
	$inserir = mysqli_query($conexao, $query);
	//echo"$query ----$idcostura"; exit;
	if ($inserir == 1) {
		echo "
							<script>
								alert('Status atualizado!');
								location.href='statuspedidocostureira.php';
							</script>
						";
	} else {
		echo "
						<script>
							alert('Não foi possível atualizar o status, tente novamente.');
							location.href='statuspedidocostureira.php';
						</script>
					";
	}
}
if (isset($_SESSION['id_cliente'])) {
	$idcli = $_SESSION['id_cliente'];
	$id_pedido = $_POST['id_pedido'];
	$id_status = $_POST['situ'];
	$idnovostatus = $_POST['novositu'];
	$query = "UPDATE pedido SET situacao = $idnovostatus  WHERE id_pedido = $id_pedido";
	$inserir = mysqli_query($conexao, $query);
	//echo"$query ----$idcli"; exit;
	if ($inserir == 1) {
		echo "
							<script>
								alert('Status atualizado!');
								location.href='statuspedidocliente.php';
							</script>
						";
	} else {
		echo "
						<script>
							alert('Não foi possível atualizar o status, tente novamente.');
							location.href='statuspedidocliente.php';
						</script>
					";
	}
}
?>