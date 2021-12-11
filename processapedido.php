<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/2e45453992.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>

<body>
    <?php
    require_once 'conexao.php';

    $id_cli = $_SESSION['id_cliente'];

    $consultas = "SELECT  nome, preco, qtd FROM carrinho WHERE sessao = '" . session_id() . "'";
    $executas = mysqli_query($conexao, $consultas);
    $descricao = "";
    while ($carrinhos = mysqli_fetch_array($executas)) {
        $convert = utf8_encode($carrinhos['nome']);
        $descricao .= $carrinhos['qtd'] . "-" . $convert . "\n";
    }
    $torax = $_POST['torax'];
    $cintura = $_POST['cintura'];
    $quadril = $_POST['quadril'];
    $pernas = $_POST['pernas'];
    $bracos = $_POST['bracos'];
    $data = "";
    $datahoje = new DateTime();
    $data = $datahoje->format('d-m-Y');
    $result = "SELECT SUM(preco * qtd) AS totales FROM carrinho WHERE sessao = '" . session_id() . "'";

    $executarr = mysqli_query($conexao, $result);
    $total = mysqli_fetch_assoc($executarr);
    $valor = $total['totales'];
    //echo"$result    ---- $valor"; exit;

    $insert = "INSERT INTO pedido (id_cliente_pedido, data_pedido, prazo, descricao, valor, id_costureira,id_entregador,situacao) VALUES ('$id_cli','$data','15 dias','$descricao', '$valor','0' ,'0', '0' )";
     //echo"$insert"; exit;
    $inserir = mysqli_query($conexao, $insert);
    //echo"$inserir"; exit;
    if ($inserir == 1) {
        $consultar = "SELECT id_cliente_medida, id_cliente FROM medidas INNER JOIN cliente ON id_cliente = id_cliente_medida WHERE id_cliente_medida = $id_cli ";
        $ver = mysqli_query($conexao, $consultar);
        while ($idmedidacliente = mysqli_fetch_assoc($ver)) {
            $idmedidacli = $idmedidacliente['id_cliente_medida'];
        }
        //echo"$idmedidacli";exit;
        if ($idmedidacli == $id_cli) {
            $query = "UPDATE medidas SET torax = $torax, cintura = $cintura, quadril =$quadril, pernas = $pernas, bracos = $bracos  WHERE id_cliente_medida = $id_cli";
            $inserir = mysqli_query($conexao, $query);
            //echo"$query ----$identregador"; exit;
            if ($inserir == 1) {
                echo "
                                                <script>
                                                    alert('Pedido cadastrado com sucesso!');
                                                    location.href='statuspedidocliente.php';
                                                </script>
                                            ";
            } else {
                echo "
                                            <script>
                                                alert('Não foi possível cadastrar as medidas, tente novamente.');
                                                history.back();
                                            </script>
                                        ";
            }
        } else {
            $inserirmedidas = " INSERT INTO medidas (id_cliente_medida, torax, cintura, quadril, pernas, bracos)  VALUES ('$id_cli','$torax', '$cintura','$quadril', '$pernas', '$bracos')  ";
            $insertmedidas = mysqli_query($conexao, $inserirmedidas);
            if ($insertmedidas == 1) {
                echo "
                            <script>
                                alert('Pedido cadastrado com sucesso!');
                                location.href='statuspedidocliente.php';
                            </script>
                        ";
            } else {
                echo "
                                <script>
                                    alert('Não foi possível cadastrar as medidas, tente novamente.');
                                    history.back();
                                </script>
                            ";
            }
        }
        echo "
                        <script>
                            alert('Pedido cadastrado com sucesso!');
                            location.href='statuspedidocliente.php';
                        </script>
                    ";



        $query = "DELETE FROM carrinho WHERE sessao = '" . session_id() . "'";
        $exec = mysqli_query($conexao, $query);

        //print_r($query); exit;

        if (mysqli_query($conexao, $query)) {

            echo "
                <script>
                    alert('Pedido computado.');
                    location.href='index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Não foi possível concluir o pedido!');
                    location.href='perfilc.php';
                </script>
            ";
        }
    } else {
        echo "
					<script>
						alert('Não foi possível efetuar o cadastro, tente novamente.');
						history.back();
					</script>
				";
    }







    ?>
</body>

</html>