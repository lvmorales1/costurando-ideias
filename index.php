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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <title>Costurando Ideias</title>
</head>

<body id="topSection">
    <?php
    require_once 'conexao.php';

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
                        <a class="bi bi-house-fill active nav-link" href="index.php">&nbsp; Home
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
                        </li>
                        ";
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

    <?php

    if (empty($_SESSION['nome']) && empty($_SESSION['email'])) {
        echo
        "
                    <div class='card shadow m-4 rounded-3 justify-content-center text-center'>
                        <div class='m-4 display-4 fw-bold'>
                            Faça seu cadastro
                        </div>
                            <div class='card-body'>
                                <h5 class='fw-bold'><i class='fas fa-tshirt'></i> Encomende com uma de nossas costureiras</h5>
                                <p class='card-text'>Cadastre-se e <a class='fs-6 text-dark' href='#produto'>fique por dentro do podemos fazer.</a></p>
                                <div class='d-flex gap-2 mt-4 text-center justify-content-center' name='cadastrar'>
                                    <a href='cadastrar-usuario.php' class='col-md-3 btn btn-outline-success'><i class='fas fa-user'></i>&nbsp; Quer ser um cliente?</a>
                                    <a href='cadastrar-costureira.php' class='col-md-3 btn btn-outline-success'><i class='fas fa-cut'></i>&nbsp; Quer ser um(a) costureira?</a>
                                    <a href='cadastrar-entregador.php' class='col-md-3 btn btn-outline-success'><i class='fas fa-shipping-fast'></i>&nbsp; Quer ser um(a) entregador?</a>
                            </div>    
                        <div class='m-4'>
                            <p class='fw-bold card-text m-4'>Já está cadastrado?</p>
                        </div>
                        <div class='dropdown'>
                            <button class='bi bi-arrow-right-square-fill btn btn-outline-success dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'> Login
                            </button>
                            <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
                                <li><a class='dropdown-item' href='login-usuario.php'><i class='fas fa-user'></i> Sou um cliente</a></li>
                                <li><a class='dropdown-item' href='login-costureira.php'><i class='fas fa-cut'></i> Sou uma costureira</a></li>
                                <li><a class='dropdown-item' href='login-entregador.php'><i class='fas fa-shipping-fast'></i> Sou um entregador</a></li>
                            </ul>
                        </div>
                    </div>
                    <hr class='m-4'>";
    }

    ?>
    <div class=" rounded-3">
        <div class=" jumbotron rounded">
            <div class="">
                <div id="carouselExampleInterval" class=" rounded carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="8000">
                            <img src="img/1.jpg" class="rounded d-block w-100" alt=" ...">
                        </div>
                        <div class="carousel-item" data-bs-interval="8000">
                            <img src="img/2.jpg" class="rounded d-block w-100" alt=" ...">
                        </div>
                        <div class="carousel-item" data-bs-interval="8000">
                            <img src="img/3.jpg" class="rounded d-block w-100" alt=" ...">
                        </div>
                        <div class="carousel-item" data-bs-interval="8000">
                            <img src="img/4.jpg" class="rounded d-block w-100" alt=" ...">
                        </div>
                        <div class="carousel-item" data-bs-interval="8000">
                            <img src="img/5.jpg" class="rounded d-block w-100" alt=" ...">
                        </div>
                        <div class="carousel-item" data-bs-interval="8000">
                            <img src="img/6.jpg" class="rounded d-block w-100" alt=" ...">
                        </div>
                        <div class="carousel-item" data-bs-interval="8000">
                            <img src="img/7.jpg" class="rounded d-block w-100" alt=" ...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden bg-dark">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden bg-dark">Próximo</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <div id="btnTop" class="fixed-action-btn smooth-scroll position-fixed bottom-0 end-0 p-3" style="display: none; z-index: 11">
        <a href='#topSection' class='btn-floating text-success bi bi-arrow-up-circle-fill fs-1' data-bs-toggle="tooltip" title="Voltar ao topo"></a>
    </div>

    <div id="produto" class="card shadow justify-content-center m-4 text-center">
        <div method="" action="" class="m-4 ms-auto d-flex col-8 mx-auto">
            <input class="mt-2 mb-2 me-2 filterinput form-control" type="search" name="searchbox" id="searchbox" placeholder="<?php if (isset($_SESSION['nome'])) {
                                                                                                                                    echo "$_SESSION[nome], o que deseja?";
                                                                                                                                } else echo "O que deseja?" ?>">
            <button class="bi bi-search mt-2 mb-2 me-4 col-md-2 btn btn-outline-success" type="submit">&nbsp; Buscar</button>
        </div>
        <div>
            <?php include_once 'card.php' ?>
        </div>
    </div>

    <hr class="m-4">

    <footer class=" m-4 rounded-3">
        <div class="px-4 pt-5 m-4 text-center">
            <h1 class="display-4 fw-bold">Costurando Ideias <img src="img/Costurando Ideias logo.png" class="me-3" width="60" height="60" class="m-4"></h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Cultivamos a ideia de criar dando autonomia para você fazer ajustes de acordo
                    com sua necessidade, além de oferecer a opção principal e sustentável, que é remodelar
                    roupas ou tecidos permitindo reaproveita-las criando novas peças a partir do tecido
                    que você já possuí, sempre com foco em oferecer um serviço de qualidade,
                    comodidade e acessível.</p>
                <div class="justify-content-sm-center mb-5">
                    <a href="sobre.php" type="button" class="btn btn-outline-success px-4"><i class="fas fa-info-circle"></i>&nbsp; Sobre nós</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        $(document).ready(function() {
            $("#searchbox").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#produtos table").filter(function() {
                    $(this).toggle($(this).find('h5').text().toLowerCase().indexOf(value) > -1)
                    $(this).toggle($(this).find('td').text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        $("#button").click(function() {
            $('html, body').animate({
                scrollTop: $("#produto").offset().top
            }, 2000);
        });
        $(function() {

            var $btn = $('#btnTop');
            var $home = $('#topSection');
            var startpoint = $home.scrollTop() + $home.height();

            $(window).on('scroll', function() {
                if ($(window).scrollTop() > startpoint) {
                    $btn.show();
                } else {
                    $btn.hide();
                }
            });
        });
    </script>

</body>

</html>