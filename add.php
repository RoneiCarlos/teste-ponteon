<?php 
    include 'conn.php';
    date_default_timezone_set('America/Sao_Paulo');

    $nome = $_POST['nome_completo'];
    $celular = $_POST['celular'];
    $cidade = $_POST['cidade'];
    $datetime = date('Y-m-d H:i');
    $pai_empresarial = $_POST['pai_empresarial'];

    
    $search = mysqli_query($con, "SELECT * FROM tb_empresarios WHERE celular = '$celular'");
    if(mysqli_num_rows($search) > 0){
        echo '
        <script>
            alert("Erro! Já existe um cadastro com esse celular. \nTente novamente.");
            window.location.assign("cadastro.php");
        </script>
        ';
    }else{

        $estado = $_POST['estado'];

        $celular_length = strlen((string)$celular);

        if($nome == ''){
            echo '<script>alert("ERRO!\nO campo Nome Completo não pode ficar vazio!");window.history.back();</script>';
        } elseif ($celular == '') {
            echo '<script>alert("ERRO!\nO campo Celular não pode ficar vazio!");window.history.back();</script>';
        } elseif ($celular_length != 11 ) {
            echo '<script>alert("ERRO!\nO campo Celular deve conter 11 dígitos!");window.history.back();</script>';
        } elseif ($estado == '') {
            echo '<script>alert("ERRO!\nO campo Estado não pode ficar vazio!");window.history.back();</script>';
        } elseif ($cidade == '') {
            echo '<script>alert("ERRO!\nO campo Cidade não pode ficar vazio!");window.history.back();</script>';
        } else {

            if($pai_empresarial==''){
                $sql = "INSERT INTO tb_empresarios (nome_completo, celular, cidade, cadastrado_em) VALUES ('".$nome."', '".$celular."', '".$cidade."', '".$datetime."')";
            } else {
                $sql = "INSERT INTO tb_empresarios (nome_completo, celular, cidade, cadastrado_em, pai_empresarial) VALUES ('".$nome."', '".$celular."', '".$cidade."', '".$datetime."', '".$pai_empresarial."')";
            }
            
            $query = mysqli_query($con, $sql);
            echo '<script>alert("SUCESSO!\nCadastrado com sucesso!");window.location.assign("index.php");</script>';
        }
    }

    mysqli_close($con);
?>