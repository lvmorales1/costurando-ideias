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

    <title>Costurando Ideias</title>
</head>

<body>

    <?php
    require_once 'conexao.php';


    if (!isset($_SESSION['id_cliente']) or  isset($_SESSION['id_costureira']) or isset($_SESSION['id_entregador'])) {
        header("Location: index.php");
    }

    ?>

    <nav class="navbar navbar-expand-lg navbar-light " style="background-color:#07f4b0" ;>
        <div class="container-fluid">

            <a class="navbar-brand" href="index.php">
                <img src="img/Costurando Ideias logo.png" width="50" height="50" class="p-1 d-inline-block align-text-top">
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
                            <li class='nav-item'><a class='bi bi-cart-fill nav-link' href='carrinho.php'>&nbsp; Carrinho</a></li>
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
                                <a class='bi bi-person-fill active nav-link' href='perfilc.php'>&nbsp; Perfil</a>
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

    <div class="m-4 p-3 card shadow rounded-3 align-text-center d-flex">
        <h2 class="display-4 d-flex"><i class="fas fa-user-alt"></i>&nbsp; <?php echo "$_SESSION[nome]"; ?> </h2>

        <hr class="m-4">

        <?php

        $query = "SELECT id_cliente, cliente.nome AS nomecliente, estado.nome AS nomeestado, cidade.nome AS nomecidade, sexo, email, telefone, cpf, rg, celular, rua, numero, complemento, cep, cliente.id_estado AS idestado, cliente.id_cidade AS idcidade FROM cliente INNER JOIN estado ON estado.id_estado = cliente.id_estado INNER JOIN cidade ON cidade.id_cidade = cliente.id_cidade WHERE id_cliente = $_SESSION[id_cliente]";
        $exec = mysqli_query($conexao, $query);

        while ($cliente = mysqli_fetch_array($exec)) {
            $city1 = utf8_encode($cliente["nomecidade"]);
            $estado1 = utf8_encode($cliente["nomeestado"]);
            $query2 = "SELECT id_estado, nome FROM estado WHERE id_estado = $cliente[idestado] ORDER BY nome ASC ";
            $executar2 = mysqli_query($conexao, $query2);

            $query3 = "SELECT id_cidade, nome FROM cidade WHERE id_cidade = $cliente[idcidade] ORDER BY nome ASC ";
            $executar3 = mysqli_query($conexao, $query3);

            if($cliente['sexo']=='M'){
                $sexo = "Masculino";
            }else if($cliente['sexo']=='F'){
                $sexo = "Feminino";
            }else{
                $sexo = "Preferiu não dizer";
            }
            // $queryestado = "SELECT id_estado, nome FROM estado WHERE id_estado = $cliente[id_estado]";
            // $execestado = mysqli_query($conexao, $query);

            // $estado = mysqli_fetch_assoc($execestado);

            echo "
                <div class='align-center d-flex mx-auto'>
                    <div class='me-3 '>
                    <h4 class='me-5 p-3'><i class='fas fa-dice'></i>&nbsp; Dados pessoais</h5>
                        <div class='mb-3 d-flex'>
                            <div class='m-3'>    
                                <span class='mb-2 d-flex fs-5'><b><i class='fas fa-id-card-alt'></i>&nbsp; Nome:</b>&nbsp; <p>$cliente[nomecliente]</p>
                                </span>
                                <span class='mb-2 d-flex fs-5'><b><i class='fas fa-at'></i>&nbsp; E-mail:</b>&nbsp; <p>$cliente[email]</p>
                                </span>
                                <span class='mb-2 d-flex fs-5'><b><i class='fas fa-id-card'></i>&nbsp; RG:</b>&nbsp; <p>$cliente[rg]</p>
                                </span>
                                <span class='mb-2 d-flex fs-5'><b><i class='fas fa-id-card'></i>&nbsp; CPF:</b>&nbsp; <p>$cliente[cpf]</p>
                                </span>
                                <span class='mb-2 d-flex fs-5'><b><i class='fas fa-venus-mars'></i>&nbsp; Sexo:</b>&nbsp; <p>$sexo</p>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class=' me-3'>
                    <h4 class='me-5 p-3 '><i class='fas fa-phone-square-alt'></i>&nbsp; Telefones</h5>
                        <div class='mb-3 d-flex'>
                            <div class='m-3'>    
                                <span class='mb-4 d-flex fs-5'><b><i class='fas fa-phone-alt'></i>&nbsp; Telefone:</b>&nbsp; <p>$cliente[telefone]</p>
                                </span>
                                <span class='mb-2 d-flex fs-5'><b><i class='fas fa-mobile-alt'></i>&nbsp; Celular:</b>&nbsp; <p>$cliente[celular]</p>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class=' me-3'>
                    <h4 class='me-5 p-3 '><i class='fas fa-map-marked-alt'></i>&nbsp; Endereço</h5>
                        <div class='mb-3 d-flex'>
                            <div class='m-3'>    
                                <span class='mb-2 d-flex fs-5'><b><i class='fas fa-map-marker-alt'></i>&nbsp; Rua:</b>&nbsp; <p>$cliente[rua]</p>
                                </span>
                                <span class='mb-2 d-flex fs-5'><b><i class='fas fa-sort-numeric-up'></i>&nbsp; Número:</b>&nbsp; <p>$cliente[numero]</p>
                                </span>
                                <span class='mb-4 d-flex fs-5'><b><i class='fas fa-map-pin'></i>&nbsp; Complemento:</b>&nbsp; <p>$cliente[complemento]</p>
                                </span>
                                <span class='mb-2 d-flex fs-5'><b><i class='fas fa-location-arrow'></i>&nbsp; CEP:</b>&nbsp; <p>$cliente[cep]</p>
                                </span> ";
            $estado = mysqli_fetch_array($executar2);
            $estad = utf8_encode($estado['nome']);
            echo "
                                <span class='mb-2 d-flex fs-5'><b><i class='fas fa-map'></i>&nbsp; Estado:</b>&nbsp; <p>$estad</p>
                                </span>";

            $cidade = mysqli_fetch_array($executar3);
            $city = utf8_encode($cidade['nome']);
            echo "<span class='mb-2 d-flex fs-5'><b><i class='fas fa-map-marked-alt'></i>&nbsp; Cidade:</b>&nbsp; <p>$city</p>
                                    </span>";

            echo "
                            </div>
                        </div>
                    </div>
                </div>
                <hr class='m-4'>
                <div class='d-flex'>
                <div class='btn-group d-flex col-4 p-3 justify-content-md-start'>
                <a href='index.php' id='button' type='submit' class='btn btn-outline-warning'><i class='fas fa-chevron-left'></i>&nbsp; Voltar</a>
                <a href='atualizar-usuario.php?id=$cliente[id_cliente]' id='button' type='submit' class='btn btn-outline-primary'><i class='fas fa-edit'></i>&nbsp; Editar informações</a>
                    </div>
                    <div class='m-3 d-flex col d-md-flex justify-content-md-end'>
                        <a href='deletar-usuario.php?deleteid=$cliente[id_cliente]' id='button' type='submit' class='btn btn-outline-danger'><i class='fas fa-user-minus'></i>&nbsp;&nbsp; Deletar conta</a>
                    </div>
                </div>              
                
                ";
        }
        ?>

    </div>
    </div>
    </div>

</body>

</html>