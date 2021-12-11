<h1>Pedido</h1>
<table class='m-3 p-3 d-grid justify-content-md-center'>

    <tr>
        <th scope='col'>Nome</th>
        <th scope='col'>Quantidade</th>
        <th scope='col'>Preço</th>

    </tr>

    <?php
    require_once 'conexao.php';

    $id_cli = $_SESSION['id_cliente'];

    $consultas = "SELECT id_cli, nomeserv, valores, qtd FROM pedidoprocess WHERE id_cli = $id_cli ";
    $executas = mysqli_query($conexao, $consultas);

    while ($carrinhos = mysqli_fetch_array($executas)) {
        $convert = utf8_encode($carrinhos['nomeserv']);
        echo "
             <tr style ='vertical-align: middle'>
                       <th scope='row''>$convert</th>
                        <td>$carrinhos[qtd]</td>
                        <td>$carrinhos[valores]</td>
                </tr>
                  ";
    }

    //print_r($consultas); exit;

    ?>
    <?php
    $result = "SELECT SUM(valores) AS totales FROM pedidoprocess WHERE id_cli = $id_cli";
    $executarr = mysqli_query($conexao, $result);
    $total = mysqli_fetch_assoc($executarr);;

    $resultad = "SELECT SUM(qtd) AS itens FROM pedidoprocess WHERE id_cli = $id_cli";
    $execu = mysqli_query($conexao, $resultad);
    $totaliten = mysqli_fetch_assoc($execu);;
    ?>
    </tbody>
</table>

<table>
    <tr>
        <th> Total de itens</th>
        <th>Total a pagar</th>
    </tr>
    <tr>
        <td> <?php echo $totaliten['itens']; ?></td>
        <td> <?php echo $total['totales']; ?> </td>
    </tr>
</table>