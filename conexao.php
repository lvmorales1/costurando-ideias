<link rel="icon" type="image/x-icon" href="img/Costurando Ideias logo.png">
<?php

session_start();

//header('Content-Type: text/html; charset=UTF-8');

//ClearDB connection
$conexao = mysqli_connect('us-cdbr-east-04.cleardb.com', 'bbcf5488316c82', '6fad3363', 'heroku_b16c28ee47822af');

//Local connection
// $conexao = mysqli_connect('localhost', 'root', '', 'costurando');

if (!$conexao) {
    echo "
    <div class='m-3 text-center'>
        <div class='m-3 text-center'>
            <div class='h4 warn rounded-3' style='color:red';>";
    die('Não foi possível se conectar: <img src="img/500.jpeg" alt=":(" class="shadow-lg rounded-3 m-3 w-50 h-100 d-grid gap-2 col-6 mx-auto align-center">');
    echo "
            </div>
        </div>
    </div>";
}

// else {
//     echo "Conexão bem-sucedida";
// }
