<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/2e45453992.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>Atualizar costureira</title>
</head>

<body>


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
                        require_once 'conexao.php';
                        //session_start();
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
                                <a class='bi bi-person-fill nav-link' href='perfilc.php'>&nbsp; Perfil</a>
                            </li>
                        ";
                    } else if (isset($_SESSION['id_costureira']) &&  isset($_SESSION['nome']) && isset($_SESSION['email'])) {
                        echo "
                            <li class='nav-item active'>
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

    <div class="">
        <?php
        require_once 'conexao.php';


        if (isset($_SESSION['id_cliente']) or !isset($_SESSION['id_costureira']) or isset($_SESSION['id_entregador'])) {
            header("Location: index.php");
        }
        $id = isset($_GET['id']) ? $_GET['id'] : 'nobody';

        $query = "SELECT id_costureira, costureira.nome AS nomecostureira, estado.nome AS nomeestado, cidade.nome AS nomecidade, sexo, senha, email, telefone, cpf, rg, celular, rua, numero, complemento, cep, costureira.id_estado AS idestado, costureira.id_cidade AS idcidade FROM costureira INNER JOIN estado ON estado.id_estado = costureira.id_estado INNER JOIN cidade ON cidade.id_cidade = costureira.id_cidade WHERE id_costureira = $id";
        $exec = mysqli_query($conexao, $query);

        $costureira = mysqli_fetch_assoc($exec);
        $city1 = utf8_encode($costureira["nomecidade"]);
        $estado1 = utf8_encode($costureira["nomeestado"]);
        $query2 = "SELECT id_estado, nome FROM estado WHERE id_estado <> $costureira[idestado] ORDER BY nome ASC ";
        $executar2 = mysqli_query($conexao, $query2);

        $query3 = "SELECT id_cidade, nome FROM cidade WHERE id_cidade <> $costureira[idcidade] ORDER BY nome ASC ";
        $executar3 = mysqli_query($conexao, $query3);

        ?>
        <div>

            <div class="m-4 jumbotron">
                <h1 class="display-4"><i class="fas fa-address-card"></i> Editar costureira</h1>
                <hr class="my-4">
            </div>

            <form action="atualizar-costureira-processa.php" method="POST" class="container">

                <div class="mb-3">
                    <h5 class="form-label"><i class="fas fa-dice"></i>&nbsp; Dados pessoais</h5>
                    <input class="form-control" type="text" name="nome" maxlength="" placeholder="Digite seu " required="required" value="<?php echo $costureira['nomecostureira']; ?>"><br>
                    <input class=" form-control" type="text" name="rg" placeholder="Digite o RG" required="required" value="<?php echo $costureira['rg']; ?>"><br>
                    <input class="form-control" type="text" name="cpf" placeholder="Digite o CPF" required="required" value="<?php echo $costureira['cpf']; ?>">
                </div>

                <label for="exampleFormControlInput1" class="form-label">Sexo:</label>
                <div class="form-check mb-3">
                <?php
                    if ($costureira['sexo']=='M'){
                        echo"
                            <input class=' form-check-input form-check-inline' type='radio' value='F'  name='sexo'><i class='fas fa-venus'></i>&nbsp; Feminino</input><br>
                            <input class='form-check-input form-check-inline' type='radio' value='M' checked='checked'  name='sexo'><i class='fas fa-mars'></i>&nbsp; Masculino </input><br>
                            <input class='form-check-input form-check-inline' type='radio' value='I'  name='sexo'><i class='fas fa-genderless'></i>&nbsp; Prefere não dizer </input><br>
                       ";

                    }else if ($costureira['sexo']=='F'){
                        echo"                    
                            <input class=' form-check-input form-check-inline' type='radio' value='F' checked='checked' name='sexo'><i class='fas fa-venus'></i>&nbsp; Feminino</input><br>
                            <input class='form-check-input form-check-inline' type='radio' value='M'   name='sexo'><i class='fas fa-mars'></i>&nbsp; Masculino </input><br>
                            <input class='form-check-input form-check-inline' type='radio' value='I'  name='sexo'><i class='fas fa-genderless'></i>&nbsp; Prefere não dizer </input><br>
                        ";
                    }else{
                            echo"
                            <input class=' form-check-input form-check-inline' type='radio' value='F'  name='sexo'><i class='fas fa-venus'></i>&nbsp; Feminino</input><br>
                            <input class='form-check-input form-check-inline' type='radio' value='M'  name='sexo'><i class='fas fa-mars'></i>&nbsp; Masculino </input><br>
                            <input class='form-check-input form-check-inline' type='radio' value='I' checked='checked' name='sexo'><i class='fas fa-genderless'></i>&nbsp; Prefere não dizer </input><br>
                       ";
                         }

                    ?>
                </div>
                <div class="mb-3">
                    <h5 class="form-label"><i class="fas fa-dice"></i>&nbsp; Dados de login</h5>
                    <input class="form-control" type="email" name="email" placeholder="Digite seu e-mail" required="required" value="<?php echo $costureira['email']; ?>"><br>
                    <input class="form-control" type="password" name="senha" placeholder="Digite sua senha" required="required" value="<?php echo $costureira['senha']; ?>">
                </div>
                <div class="mb-3">
                    <h5 class="form-label"><i class="fas fa-phone-square-alt"></i>&nbsp; Telefones</h5>
                    <input class="form-control" type="text" name="telefone" placeholder="Digite o telefone residencial" value="<?php echo $costureira['telefone']; ?>"><br>
                    <input class="form-control" type="text" name="celular" placeholder="Digite o telefone celular" value="<?php echo $costureira['celular']; ?>">
                </div>
                <div class="mb-3">
                    <h5 class="form-label"><i class="fas fa-map-marked-alt"></i>&nbsp; Endereço</h5>
                    <input class="form-control" type="text" name="rua" placeholder="Digite o nome da rua" required="required" value="<?php echo $costureira['rua']; ?>"><br>
                    <input class="form-control" type="text" name="numero" placeholder="Digite o número da rua" required="required" value="<?php echo $costureira['numero']; ?>"><br>

                    <!-- <i class="bi bi-info-square-fill flex-shrink-0 align-items-center me-1 alert alert-warning" role="alert">&nbsp; Complemento opcional.</i>
                             -->
                    <div class="d-flex">
                        <textarea class=" me-2 form-control" data-bs-toggle="collapse" data-bs-target="#collapseExample" name="complemento" placeholder="Digite o complemento"><?php echo $costureira['complemento']; ?></textarea>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body alert-success ">Complemento opcional.</div>
                        </div>
                    </div><br>
                    <input class="form-control" type="text" name="cep" placeholder="Digite o CEP" required="required" value="<?php echo $costureira['cep']; ?>"><br>

                    <select class="form-select" name="estados" id="estados" required="required">
                        <?php

                        echo "<option value='$costureira[idestado]'>$estado1</option>";
                        while ($estado = mysqli_fetch_array($executar2)) {
                            $estad = utf8_encode($estado['nome']);
                            echo "<option value='$estado[id_estado]'>$estad</option>";
                        }
                        echo "
                        </select></td>

                        <td>
                        <br>
                        <select class='form-select' name='cidades'>

                        <option value='$costureira[idcidade]'>$city1</option>
                        ";

                        while ($cidade = mysqli_fetch_array($executar3)) {
                            $city = utf8_encode($cidade['nome']);
                            echo "<option value='$cidade[id_cidade]'>$city</option>";
                        }

                        ?>
                    </select>

                </div>
                <div class="btn-group d-flex col-4 mb-4 justify-content-md-start">
                    <a href="perfilc.php" id="button" type="submit" class="btn btn-outline-warning"><i class="fas fa-chevron-left"></i>&nbsp; Voltar</a>
                    <button id="button" type="submit" name="editar" class="btn rounded btn-outline-primary"><i class="fas fa-edit"></i>&nbsp; Editar informações</button>
                    <input type="hidden" name="id" value="<?php echo $costureira['id_costureira']; ?>">
                </div>
            </form>
        </div>
    </div>
    </div>
</body>

</html>
<script>
    $("#estados").on("change", function() {
        var idEstado = $("#estados").val();
        $.ajax({
            url: 'pega_cidades.php',
            type: 'POST',
            data: {
                id: idEstado
            },
            beforeSend: function() {
                $("#cidades").css({
                    'display': 'block'
                });
                $("#cidades").html("Carregando...");
            },
            success: function(data) {
                $("#cidades").css({
                    'display': 'block'
                });
                $("#cidades").html(data);
            },
            error: function(data) {
                $("#cidades").css({
                    'display': 'block'
                });
                $("#cidades").html("Houve um erro ao carregar");
            }
        });
    });
</script>