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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <title>Processa serviços</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <?php
            require_once 'conexao.php';


            if (isset($_POST['cadastrar'])) {

                $nome = mysqli_real_escape_string($conexao, $_POST['nomes']);
                $img = $_FILES['foto'];

                if ($img['error'] == 4) {
                    echo "<script>
                    alert('Envie uma foto do serviço');
                    history.back();
                </script>
                ";
                } else if ($img['error'] == 1) {
                    echo "<script>
                    alert('Arquivo muito grande');
                    history.back();
                </script>
                ";
                } else if (!preg_match("/(.)+(jpg|JPG|jpeg|JPEG|png|PNG|gif|GIF|bmp|BMP)/", $img["name"])) {
                    echo "<script>
                            alert('Você não enviou a imagem');
                            history.back();
                        </script>
			";
                } else {
                    $dimensoes = getimagesize($img['tmp_name']); // pegar largura e altura da img
                    //print_r($dimensoes);exit;

                    $extensao = explode(".", $img['name']);
                    $ext = $extensao[1];
                    $nomeimagem = md5(uniqid(time())) . "." . $ext;
                    $origem = $img['tmp_name'];
                    $destino = "imagens/" . $nomeimagem;



                    $decricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
                    $valorunitario = mysqli_real_escape_string($conexao, $_POST['valorunitario']);
                    $tipo = mysqli_real_escape_string($conexao, $_POST['tiporoupa']);


                    $nomem = strtolower($nome);

                    $decricaom = strtolower($decricao);
                    $valorunitariom = strtolower($valorunitario);

                    $nome = ucwords($nomem);

                    $descricao = ucfirst($decricaom);
                    $valorunitario = ucfirst($valorunitariom);
                    //echo"$nome, $costureira, $tipo";exit;

                    $contanome = strlen($nome);

                    $contadesc = strlen($decricao);
                    $contavaloreu = strlen($valorunitario);

                    if ($contanome > 50) {
                        echo "
            <script>
                alert('O nome do serviço é muito grande para o campo!');
                history.back();
            </script>
        ";
                    } elseif ($contadesc > 200) {
                        echo "
            <script>
                alert('A descrião é muito grande para o campo!');
                history.back();
            </script>
        ";
                    } elseif ($contavaloreu > 50) {
                        echo "
            <script>
                alert('A valor é muito grande para o campo!');
                history.back();
            </script>
        ";
                    } else {


                        $query = ("INSERT INTO tipo_servico (nome, descricao, valor, foto, id_tiporoupa) 
            VALUES ('$nome','$descricao','$valorunitario','$nomeimagem','$tipo')");
                        $exec = mysqli_query($conexao, $query);
                        //print_r($query); exit;
                        if ($exec == 1) {
                            $upar = move_uploaded_file($origem, $destino);
                            echo "
                <script>
                    alert('Serviço cadastrado com sucesso!');
                    location.href='index.php';
                </script>
            ";
                        } else {
                            echo "
                <script>
                    alert('Não foi possível cadastrar o serviço, tente novamente!');
                    history.back();
                </script>
            ";
                        }
                    }
                }
            }
            ?>

        </div>
    </div>

</body>

</html>