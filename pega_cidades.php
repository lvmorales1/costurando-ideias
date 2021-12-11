<?php
include_once 'conexao.php';
$query = "SELECT * FROM cidade WHERE id_estado='" . $_POST['id'] . "'";
$executa = mysqli_query($conexao, $query);
echo "<option value=''>Escolha sua cidade</option>";
while ($cidades = mysqli_fetch_array($executa)) {
    $cid = utf8_encode($cidades['nome']);
    echo "<option value='$cidades[id_cidade]'>$cid</option>";
}
