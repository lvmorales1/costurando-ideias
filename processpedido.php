<?php
require_once 'conexao.php';

$i = 0;
$consultas = "SELECT  nome, preco, qtd FROM carrinho WHERE sessao = '". session_id()."'";
$executas = mysqli_query($conexao, $consultas);

    while($car = mysqli_fetch_array($executas))
    
{
    //print_r($car); exit;
    $nomes = $car['nome'];
    $qtd = $car['qtd'];
    $valores = $car['preco'];

    $arraynomes[$i] = $nomes;
    $arrayqtd[$i] = $qtd;
    $arrayvalores[$i] = $valores;
     $i++;

     //print_r($arraynomes); exit;
    }
    
    $k =$i;
    $id_cli= $_SESSION['id_cliente'];
    for ($i=0 ;$i<$k; $i++){

        
        $querytt = "INSERT INTO pedidoprocess 
        (id_cli, nomeserv, qtd, valores) VALUES
        ($id_cli,'$arraynomes[$i]',$arrayqtd[$i],$arrayvalores[$i])";
        $inserett = mysqli_query($conexao,$querytt);
    }
    //print_r($querytt); exit;
    if($inserett==1){
		echo "
				<script>
					alert('Pedido cadastrado com sucesso!');
					location.href='pedido.php';
				</script>
			";
	}else{
		echo "
				<script>
					alert('Ops, deu ruim!');
					history.back();
				</script>
			";
	}

//print_r($arraynomes);


 ?>