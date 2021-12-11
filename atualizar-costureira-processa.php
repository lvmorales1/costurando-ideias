<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="pt-br">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar costureira</title>
</head>

<body>
    <?php

    //session_start();
    require_once 'conexao.php';

    $nome = $_POST["nome"];
    $rg = $_POST["rg"];
    $cpf = $_POST["cpf"];
    $rua = $_POST["rua"];
    $numero = $_POST["numero"];
    $cep = $_POST["cep"];
    $municipio = $_POST["cidades"];
    $estado = $_POST["estados"];
    $complemento = $_POST["complemento"];
    $telefone = $_POST["telefone"];
    $celular = $_POST["celular"];
    $sexo = $_POST["sexo"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    //echo "$nome,- $rg,- $cep,- $cpf,- $estado, -$municipio";
    //exit();
    $cpfform = formato($cpf);
    //echo"$cpfform";
    //exit;
    //date_default_timezone_set('America/Sao_Paulo');
    //$data_timestamp= strtotime(str_replace('/','-',$data));
    //$data_americana=date("Y/m/d",$data_timestamp);
    //echo"$data_americana";
    //exit();

    ?>
    <?php

    function validaCPF($lcpf)
    {


        $ncpf = preg_replace('/[^0-9]/', '', $lcpf);

        if (strlen($ncpf) != 11) {
            return false;
        } else {

            if (preg_match('/(\d)\1{10}/', $ncpf)) {
                return false;
            } else {


                $valid = str_split($ncpf);
                $a = 0;
                $b = 10;
                $c = 0;

                while ($b >= 2) {
                    $c += $valid[$a] * $b;
                    $a++;
                    $b--;
                }
                if ((($c * 10) % (($c * 10) / 11)) != $valid[9]) {
                    return false;
                }
                $d = 0;
                $e = 11;
                $f = 0;
                while ($e >= 2) {
                    $f += $valid[$d] * $e;
                    $d++;
                    $e--;
                }
                if ((($f * 10) % (($f * 10) / 11)) != $valid[10]) {
                    return false;
                }
            }
            return true;
        }
    }
    ?>
    <?php

    function formato($mcpf)
    {
        $ocpf = preg_replace('/[^0-9]/', '', $mcpf);
        if (strlen($ocpf) != 11) {
            return false;
        } else {

            $cpfformatado = substr($ocpf, 0, 3) . '.' .
                substr($ocpf, 3, 3) . '.' .
                substr($ocpf, 6, 3) . '-' .
                substr($ocpf, 9, 2);
            return $cpfformatado;
        }
    }

    //echo $nome $data $cpf $rua $numero $cep $municipio $estado $complemento $obs $telefone $sexo";
    $contanome = strlen($nome);
    $contarg = strlen($rg);
    $contacpf = strlen($cpf);
    $contarua = strlen($rua);
    $contanumero = strlen($numero);
    $contacep = strlen($cep);
    $contacomplemento = strlen($complemento);
    $contatelefone = strlen($telefone);
    $contacelular = strlen($celular);
    $contasexo = strlen($sexo);
    //echo"$contanome";
    //exit();
    if ($contanome > 50) {
        echo "
			<script>
				alert('O nome é muito grande.');
				history.back();
			</script>
			";
    } elseif ($contarg > 14) {
        echo "
				<script>
					alert('O número RG é muito grande.');
					history.back();
				</script>
				";
    } elseif ($contacpf > 14) {
        echo "
				<script>
					alert('O número CPF é inválido.');
					history.back();
				</script>
				";
    } elseif ($contarua > 50) {
        echo "
				<script>
					alert('O nome da rua é muito grande.');
					history.back();
				</script>
				";
    } elseif ($contanumero > 20) {
        echo "
				<script>
					alert('O número da casa é muito grande.');
					history.back();
				</script>
				";
    } elseif ($contacep > 11) {
        echo "
				<script>
					alert('O número do CEP é inválido.');
					history.back();
				</script>
				";
    } elseif ($contacomplemento > 200) {
        echo "
				<script>
					alert('O complemento é muito grande.');
					history.back();
				</script>
				";
    } elseif ($contacelular == 15) {
        echo "
			<script>
				alert('O número de celular é muito grande.');
				history.back();
			</script>
			";
    } elseif ($contatelefone > 11) {
        echo "
				<script>
					alert('O número de telefone é muito grande.');
					history.back();
				</script>
				";
    } elseif (validaCPF($cpf) == false) {
        echo "
			<script>
				alert('CPF inválido.');
				history.back();
			</script>
			";
    } else {
        $senhas = sha1($senha);
        //$senhas = password_hash($senha, PASSWORD_DEFAULT);
        //$senhas = md5($senha);

        //echo "$nome---$data_americana---$rg---$cpf---$rua---$numero---$cep---$municipio---$estado---$complemento---$obs---$telefone---$sexo";
        //exit;

        $query = "UPDATE costureira SET nome = '$nome', rg = '$rg', cpf = '$cpfform', rua='$rua', numero = '$numero', cep = '$cep', complemento = '$complemento', telefone = '$telefone', sexo = '$sexo', celular = '$celular', email = '$email', senha = '$senhas', id_estado = '$estado', id_cidade = '$municipio' WHERE id_costureira = $_SESSION[id_costureira]";
        // print_r($query);
        // exit;
        $inserir = mysqli_query($conexao, $query);
        if ($inserir == 1) {
            echo "
					<script>
						alert('$nome atualizado com sucesso!');
						location='perfilcus.php';
					</script>
				";
        } else {
            echo "
					<script>
						alert('Não foi possível efetuar a edição, tente novamente.');
						history.back();
					</script>
				";
        }
    }

    ?>
</body>

</html>