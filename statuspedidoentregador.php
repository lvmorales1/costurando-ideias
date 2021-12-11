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


  <title>Status do pedido</title>
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
            <a class="bi bi-house-fill   nav-link" href="index.php">&nbsp; Home
              <span class="visually-hidden"></span>
            </a>
          </li>

          <li class="nav-item">
            <?php
          require_once 'conexao.php';
            //session_start();

            if (isset($_SESSION['id_cliente']) or  isset($_SESSION['id_costureira']) or !isset($_SESSION['id_entregador'])) {
              header("Location: index.php");
            };
            //echo "$_SESSION[id_cliente] $_SESSION[id_costureira] - $_SESSION['id_entregador'] ";
            //exit;
            // $id_cli = $_SESSION['id_cliente'];
            if (isset($_SESSION['id_cliente'])) {
              echo "
                            <li class='nav-item'><a class='bi bi-cart-fill nav-link' href='carrinho.php'>&nbsp; Carrinho</a></li>
                            <a class='nav-link active' href='statuspedidocliente.php'><i class='fas fa-shopping-bag'></i>&nbsp; Meu pedido</a>";
            }
            if (isset($_SESSION['id_costureira'])) {
              echo "<a class='nav-link' href='statuspedidocostureira.php'><i class='fas fa-cut'></i>&nbsp; Meus serviços</a>";
            }
            if (isset($_SESSION['id_entregador'])) {
              echo "<a class='nav-link active' href='statuspedidoentregador.php'><i class='fas fa-shipping-fast'></i>&nbsp; Minhas entregas</a>";
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
    <table class='table text-center table-hover'>
      <thead>
        <th scope='col'><i class="fas fa-sort-numeric-up-alt"></i>&nbsp; Número do pedido</th>
        <th scope='col'><i class="fas fa-calendar-check"></i>&nbsp; Data da solicitação</th>
        <th scope='col'><i class="fas fa-clock"></i>&nbsp; Prazo</th>
        <th scope='col'><i class="fas fa-align-left"></i>&nbsp; Descrição do pedido</th>
        <th scope='col'><i class="fas fa-ruler-vertical"></i>&nbsp; Endereço da Costureira</th>
        <th scope='col'><i class="fas fa-ruler-vertical"></i>&nbsp; Endereço do Cliente</th>
        <th scope='col'><i class="fas fa-exclamation-circle"></i>&nbsp; Status</th>
        <th scope='col'><i class="fas fa-edit"></i>&nbsp; Atualizar status</th>
      </thead>
      <?php
      //require_once 'conexao.php';

      if (isset($_SESSION['id_cliente']) or  isset($_SESSION['id_costureira']) or !isset($_SESSION['id_entregador'])) {
        header("Location: index.php");
      }

      $id_cli = $_SESSION['id_entregador'];
      $query = "SELECT id_pedido, data_pedido, prazo, descricao, valor,situacao, pedido.id_costureira, estado.nome AS nomeestado, cidade.nome AS nomecidade, cliente.id_cliente, id_cliente_pedido, cliente.rua AS rua, cliente.numero AS nu, cliente.cep AS cep, cliente.id_cidade AS idcidade, cliente.id_estado AS idestado, costureira.rua AS rua1, costureira.numero AS nu1, costureira.cep AS cep1, costureira.id_cidade AS idcidade1, costureira.id_estado AS idestado1, pedido.id_entregador FROM pedido INNER JOIN cliente ON id_cliente = id_cliente_pedido INNER JOIN costureira ON costureira.id_costureira = pedido.id_costureira INNER JOIN estado ON estado.id_estado = cliente.id_estado INNER JOIN cidade ON cidade.id_cidade = cliente.id_cidade WHERE id_entregador = $id_cli ";
      $executarr = mysqli_query($conexao, $query);
      //print_r($query);exit;
      while ($mostrar = mysqli_fetch_assoc($executarr)) {
        $city1 = utf8_encode($mostrar["nomecidade"]);
        $estado1 = utf8_encode($mostrar["nomeestado"]);
        $query2 = "SELECT id_estado, nome FROM estado WHERE id_estado = $mostrar[idestado] ORDER BY nome ASC ";
        $executar2 = mysqli_query($conexao, $query2);

        $query3 = "SELECT id_cidade, nome FROM cidade WHERE id_cidade = $mostrar[idcidade] ORDER BY nome ASC ";
        $executar3 = mysqli_query($conexao, $query3);
        $convert =  ($mostrar['descricao']);
        echo "
            <tr>
                <td scope='row'>$mostrar[id_pedido]</td>
                <td scope='row'>$mostrar[data_pedido]</td>
                <td scope='row'>$mostrar[prazo]</td>
                <td scope='row'>$convert</td>
                <td scope='row'>$mostrar[rua1], $mostrar[nu1] - $mostrar[cep1] - $city1 - $estado1</td>
                <td scope='row'>$mostrar[rua], $mostrar[nu] - $mostrar[cep] - $city1 - $estado1</td>
                <td scope='row'>
                ";
        if ($mostrar['situacao'] == 0) {
          echo "<i class='fas fa-cut'></i>&nbsp; Aguardando costureira
          <div class='progress mt-2'>
            <div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' style='width: 12%;' aria-valuenow='12' aria-valuemin='0' aria-valuemax='100'>12%</div>
          </div>";
        }
        if ($mostrar['situacao'] == 1) {
          echo "<i class='fas fa-cut'></i>&nbsp; Aguardando entregador
          <div class='progress mt-2'>
            <div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' style='width: 25%;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>25%</div>
          </div>";
        }
        if ($mostrar['situacao'] == 2) {
          echo "<i class='fas fa-people-carry'></i>&nbsp; Aguardando entregador retirar o pedido
          <div class='progress mt-2'>
            <div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' style='width: 37%;' aria-valuenow='37' aria-valuemin='0' aria-valuemax='100'>37%</div>
          </div>";
        }
        if ($mostrar['situacao'] == 3) {
          echo "<i class='fas fa-route'></i>&nbsp; Pedido em rota para costureira
          <div class='progress mt-2'>
            <div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' style='width: 50%;' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100'>50%</div>
          </div>";
        }
        if ($mostrar['situacao'] == 4) {
          echo "<i class='fas fa-shipping-fast'></i>&nbsp; Pedido está sendo preparado
          <div class='progress mt-2'>
            <div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' style='width: 62%;' aria-valuenow='62' aria-valuemin='0' aria-valuemax='100'>62%</div>
          </div>";
        }
        if ($mostrar['situacao'] == 5) {
          echo "<i class='fas fa-check-circle'></i>&nbsp; Pedido preparado
          <div class='progress mt-2'>
            <div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' style='width: 75%;' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100'>75%</div>
          </div>";
        }
        if ($mostrar['situacao'] == 6) {
          echo "<i class='fas fa-route'></i>&nbsp; Pedido em rota para cliente
          <div class='progress mt-2'>
            <div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' style='width: 87%;' aria-valuenow='87' aria-valuemin='0' aria-valuemax='100'>87%</div>
          </div>";
        }
        if ($mostrar['situacao'] == 7) {
          echo "<i class='fas fa-check-circle'></i>&nbsp; Pedido pronto
          <div class='progress mt-2'>
            <div class='progress-bar bg-success' role='progressbar' style='width: 100%;' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'>100%</div>
          </div>";
        }
        echo "
                 </td>
                 
                 <td>
                 
                 ";
        if ($mostrar['situacao'] == 2) {

          echo "
                      <form action='processstatus.php' class='' method='POST'>
                      <input type='checkbox' checked class='hidden' name='situ' value='$mostrar[situacao]' style='display:none;'/>
                      <input type='checkbox' checked class='hidden' name='novositu' value='3' style='display:none;'/>
                      <button type='submit' class=' btn btn-outline-success' name='id_pedido' value='$mostrar[id_pedido]'><i class='fas fa-check-circle'></i>&nbsp; Pedido retirado</button>
                      </form> ";
        }
        if ($mostrar['situacao'] == 5) {
          echo "
                      <form action='processstatus.php' method='post'>
                      <input type='checkbox' checked class='hidden' name='situ' value='$mostrar[situacao]'style='display:none;'/>
                      <input type='checkbox' checked class='hidden' name='novositu' value='6' style='display:none;'/>
                      <button type='submit' class='btn btn-outline-success' name='id_pedido' value='$mostrar[id_pedido]'><i class='fas fa-check-circle'></i>&nbsp; Enviar para o cliente</button>
                      </form> ";
        }
        echo "
                
                </td>
    </tr>
        ";
      }
      ?>
    </table>
    <div class="ms-auto m-4 fs-5">
      <a href='notificaentregador.php' id='button' type='submit' class='ms-4 mr-4 btn btn-outline-primary'><i class="fas fa-bell"></i>&nbsp; Notificações</a>
    </div>
    <ul>
      <div id="content-notifi">
      </div>
    </ul>
  </div>


</body>

</html>