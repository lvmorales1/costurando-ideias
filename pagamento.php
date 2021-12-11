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

    <title>Pagamento</title>
</head>

<body>
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
                        require_once 'conexao.php';
                        //session_start();
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
        <h1 class="m-4 text-center"><i class="fas fa-shopping-cart"></i>&nbsp; Pedido</h1>
        <table class="table align-center text-center table-hover">
            <thead class="">
                <th scope="col"><i class="fas fa-tshirt"></i>&nbsp; Produto</th>
                <th scope="col"><i class="fas fa-sort-amount-up-alt"></i>&nbsp; Quantidade</th>
                <th scope="col"><i class="fas fa-coins"></i>&nbsp; Subtotal</th>
            </thead>

            <?php
            require_once 'conexao.php';

            $id_cli = $_SESSION['id_cliente'];

            $consultas = "SELECT  nome, preco, qtd FROM carrinho WHERE sessao = '" . session_id() . "'";
            $executas = mysqli_query($conexao, $consultas);

            while ($carrinhos = mysqli_fetch_array($executas)) {
                $convert = utf8_encode($carrinhos['nome']);
                echo "
                    <tr  class='align-center'>
                        <td scope='row''>$convert</td>
                            <td scope='row'>$carrinhos[qtd]</td>
                            <td scope='row'>$carrinhos[preco]</td>
                    </tr>";
            }

            //print_r($consultas); exit;

            ?>
            <?php
            $result = "SELECT SUM(preco * qtd) AS totales FROM carrinho WHERE sessao = '" . session_id() . "'";
            $executarr = mysqli_query($conexao, $result);
            $total = mysqli_fetch_assoc($executarr);;

            $resultad = "SELECT SUM(qtd) AS itens FROM carrinho WHERE sessao = '" . session_id() . "'";
            $execu = mysqli_query($conexao, $resultad);
            $totaliten = mysqli_fetch_assoc($execu);;

            ?>
            </tbody>
        </table>
        <div class="d-flex ms-auto m-4 fs-5"><i class="fas fa-money-bill-wave"></i>&nbsp; Total a pagar:&nbsp;<?php echo "<b>R$ $total[totales]</b>"; ?>
            <div class="ms-4 mr-4 fs-5"><i class="fas fa-money-bill-wave"></i>&nbsp; Total de itens:&nbsp;<?php echo "<b>$totaliten[itens]</b>"; ?></div>
        </div>
        <hr class="m-4">
        <form action="processapedido.php" method="post">
            <div class="d-flex">
                <div class="row m-4">
                    <h1 class=""><i class="mb-4 fas fa-ruler-vertical"></i>&nbsp; Medidas</h1>
                    <input class="mb-4 form-control" type="number" name="torax" maxlength="" placeholder="Digite a medida do seu busto" required="required"><br>
                    <input class="mb-4 form-control" type="number" name="cintura" maxlength="" placeholder="Digite a medida da sua cintura" required="required"><br>
                    <input class="mb-4 form-control" type="number" name="quadril" maxlength="" placeholder="Digite a medida do seu quadril" required="required"><br>
                    <input class="mb-4 form-control" type="number" name="pernas" maxlength="" placeholder="Digite a medida da suas pernas" required="required"><br>
                    <input class=" form-control" type="number" name="bracos" maxlength="" placeholder="Digite a medida do seus braços" required="required"><br>
                </div>

                <div class="row m-4">
                    <h1 class=""><i class="mb-4 far fa-credit-card"></i>&nbsp; Pagamento</h1>
                    <input class="mb-4 form-control" type="number" name="card" maxlength="" placeholder="Digite o número do cartão" required="required"><br>
                    <input class="mb-4 form-control" type="date" name="data" maxlength="" placeholder="Data de validade" required="required"><br>
                    <input class="mb-4 form-control" type="number" name="codigo" maxlength="" placeholder="CVV" required="required"><br>
                    <input class="mb-4 form-control" type="text" name="card" maxlength="" placeholder="Nome impresso no cartão" required="required"><br>
                    <input class=" form-control" type="cpf" name="card" maxlength="" placeholder="CPF do titular" required="required"><br>
                </div>
            </div>
            <div class="d-grid d-md-flex mb-4 me-4 ms-auto col-2 justify-content-md-end btn-group">
                <a href='carrinho.php' id='button' type='submit' class='btn btn-outline-warning'><i class='fas fa-chevron-left'></i>&nbsp; Voltar</a>
                <button id='button' type='submit' class='btn btn-outline-success'><i class="fas fa-check-circle"></i>&nbsp; Comprar</button>
            </div>
        </form>
    </div>
</body>

</html>