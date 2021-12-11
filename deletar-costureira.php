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

    <title>Excluir costureira</title>
</head>

<body>

    <div class="container">
        <div class="row">

            <?php
            require_once 'conexao.php';

            if (isset($_GET['deleteid'])) {
                $id = $_GET['deleteid'];

                // DELETE cr, c
                // FROM provider_contact_x_role AS cr
                // INNER JOIN provider_contact AS c
                // ON cr.contact_id = c.id
                // WHERE c.is_test_contact = 0;

                $query = "DELETE FROM costureira WHERE id_costureira = $id";
                $exec = mysqli_query($conexao, $query);

                print_r($query);

                if (mysqli_query($conexao, $query)) {
                    session_destroy();
                    echo "
                <script>
                    alert('Usuário deletado com sucesso.');
                    location.href='index.php';
                </script>
            ";
                } else {
                    echo "
                <script>
                    alert('Não foi possível deletar o usuário!');
                    location.href='perfilcus.php';
                </script>
            ";
                }
            }
            ?>

            <a href="perfilc.php" id="button" type="submit" class="btn btn-outline-warning"><i class="fas fa-chevron-left"></i>&nbsp; Voltar</a>

        </div>
    </div>

</body>

</html>