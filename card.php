<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Costurando Ideias</title>
</head>

<body>
    <?php
    require_once 'conexao.php';

    if (!empty($_SESSION['id_cliente'])) {
        $idcliente = $_SESSION['id_cliente'];
        $querycidade = " SELECT id_cidade FROM cliente WHERE id_cliente= $idcliente ";
        $mostrar = mysqli_query($conexao, $querycidade);
        while ($cidades = mysqli_fetch_array($mostrar)) {
            $local = $cidades['id_cidade'];
        }
        //echo "$local"; exit;
        $buscacostureira = "SELECT id_costureira FROM costureira WHERE id_cidade = $local";
        $exibir = mysqli_query($conexao, $buscacostureira);
        $arrycostureira = array();
        $z = 0;
        while ($city = mysqli_fetch_array($exibir)) {

            $arrycust = $city['id_costureira'];
            $arrycostureira[$z] = $arrycust;
            //echo"$arrycust"; exit;
            $z = $z + 1;
            //print_r($buscacostureira);
            //print_r($city['id_costureira']);

        }
        if (!empty($arrycostureira)) {
            //print_r($arrycostureira);
            //exit;
            $arrayservico = array();
            $x = 0;
            foreach ($arrycostureira as $costureiraid) {
                $qrservico = "SELECT id_costureira, id_tiposervicos FROM servicos WHERE id_costureira = $costureiraid";
                $exibir2 = mysqli_query($conexao, $qrservico);

                while ($servicoid = mysqli_fetch_array($exibir2)) {
                    $arrayservico[$x] = $servicoid['id_tiposervicos'];

                    $x = $x + 1;
                }
            }

            $arryuni = array_unique($arrayservico);

            //print_r($arryuni); exit;
            $consultas = "SELECT id_tiporoupa, nome FROM tipo_roupa ";
            $executas = mysqli_query($conexao, $consultas);

            echo "<div class='mb-4 d-flex justify-content-center'>";

            while ($roupa = mysqli_fetch_array($executas)) {

                $consulta = "SELECT id_tiposervico, foto, tipo_servico.nome AS tiponome, valor, descricao, tipo_servico.id_tiporoupa, tipo_roupa.id_tiporoupa, tipo_roupa.nome FROM tipo_servico INNER JOIN tipo_roupa ON tipo_roupa.id_tiporoupa = tipo_servico.id_tiporoupa WHERE tipo_servico.id_tiporoupa =$roupa[id_tiporoupa]  ";
                $executar = mysqli_query($conexao, $consulta);
                //print_r($consulta); exit;
                echo "
                <div>
                    <table id='produtos' class='d-flex justify-content-center'>
                <tr>";

                $roup = utf8_encode($roupa['nome']);

                echo "<div class='rounded me-4 ms-4 card-header' style='background-color: #07f4b0';><h3>$roup</h3></div>";

                $a = 0;

                while ($produto = mysqli_fetch_array($executar)) {
                    $prod = utf8_encode($produto['tiponome']);
                    if ($a == 0) {
                        echo "
                            </tr>
                            <tr class='row m-3 row-cols-1 row-cols-md-3'>
                        ";
                        $a = 0;
                    }

                    $a = $a + 1;
                    echo "
                        <td class='col mb-4'>
                                <table class='shadow rounded-3 card h-60 w-60'>
                                <form id='formulario' action='carrinho.php' method='get'>
                                    <tr class='rounded'><td><img src='./imagens/" . $produto['foto'] . "'class='card-img-top' ></td></tr>
                                <div class='card-body'> 
                                    <tr class='card-title'><td><h5>$prod</h5></td></tr>
                                    <tr class='card-text'><td><p>" . utf8_encode($produto['descricao']) . "</p></td></tr>
                                </div>
                                <td class='card-footer'>
                                    <tr class='price'><td><i class='fas fa-tags'></i>&nbsp; R$ $produto[valor]</td></tr>
                                    <tr class='d-grid m-4 gap-2'><td>
                                    <a href='carrinho.php?cod=$produto[id_tiposervico].&acao=$prod' type='button' class=' bi bi-cart-fill btn btn-outline-success btn'<?php start_session['']> Adicionar ao carrinho</a>
                                    </td></tr>
                                </td>        
                                    </form>
                                </table>     
                        </td>";
                }
                echo "
                    </tr>
                </table>";
            }
            echo "
         </div>
         </div>";
        } else {
            echo "  <script>
                        alert('Não há costureiras cadastradas na sua cidade no momento, recomende o nosso site ou mude sua cidade.');
                        location='perfilc.php';
                    </script>";
        }
    } else {

        $consultas = "SELECT id_tiporoupa, nome FROM tipo_roupa ";
        $executas = mysqli_query($conexao, $consultas);

        echo "<div class='d-flex justify-content-center'>";

        while ($roupa = mysqli_fetch_array($executas)) {

            $consulta = "SELECT id_tiposervico, foto, tipo_servico.nome AS tiponome, valor, descricao, tipo_servico.id_tiporoupa, tipo_roupa.id_tiporoupa, tipo_roupa.nome FROM tipo_servico INNER JOIN tipo_roupa ON tipo_roupa.id_tiporoupa = tipo_servico.id_tiporoupa WHERE tipo_servico.id_tiporoupa =$roupa[id_tiporoupa]  ";
            $executar = mysqli_query($conexao, $consulta);
            //print_r($consulta); exit;
            echo "
                <div>
                    <table id='produtos' class='d-flex justify-content-center'>
                <tr>";

            $roup = utf8_encode($roupa['nome']);

            echo "<div class='rounded m-4 card-header' style='background-color: #07f4b0';><h3>$roup</h3></div>";

            $a = 0;

            while ($produto = mysqli_fetch_array($executar)) {
                $prod = utf8_encode($produto['tiponome']);
                if ($a == 0) {
                    echo "
                            </tr>
                            <tr class='row m-3 row-cols-1 row-cols-md-3'>
                        ";
                    $a = 0;
                }

                $a = $a + 1;
                echo "
                        <td class='col mb-4' id='produtos'>
                                <table class='shadow rounded-3 card h-60 w-60'>
                                <form id='formulario' action='carrinho.php' method='get'>
                                    <tr class='rounded'><td><img src='./imagens/" . $produto['foto'] . "'class='card-img-top' ></td></tr>
                                <div class='card-body'> 
                                    <tr class='card-title'><td><h5>$prod</h5></td></tr>
                                    <tr class='card-text'><td><p>" . utf8_encode($produto['descricao']) . "</p></td></tr>
                                </div>
                                <td class='card-footer'>
                                    <tr class='price'><td><i class='fas fa-tags'></i>&nbsp; R$ $produto[valor]</td></tr>
                                    <tr class='d-grid m-4 gap-2'><td>
                                    <a href='login-usuario.php?cod=$produto[id_tiposervico].&acao=$prod' type='button' class=' bi bi-cart-fill btn btn-outline-success btn'<?php start_session['']> Adicionar ao carrinho</a>
                                    </td></tr>
                                </td>        
                                    </form>
                                </table>     
                        </td>";
            }
            echo "
                    </tr>
                </table>";
        }
        echo "
         </div>
         </div>";
    }

    ?>
    <script>
        (function($) {
            "use strict";
            $('.next').click(function() {
                $('.carousel').carousel('next');
                return false;
            });
            $('.prev').click(function() {
                $('.carousel').carousel('prev');
                return false;
            });
        })
        (jQuery);
    </script>

</body>

</html>