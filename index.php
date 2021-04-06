<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://ponteon.com.br/assets/images/favicon.png">
    <title>Cadastro de Empresários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        include 'conn.php';
        
        if(!$con){
            alert(die("Falha na conexao: ".mysqli_connect_error()));
        }
    ?>

    <div class="total">
        <div class="center">
            <form method="post" action="add.php">
                <label>Nome Completo: <br><input type="text" name="nome_completo" id="nome_completo" required></label>
                <br>
                <label>Celular: <br><input type="tel" name="celular" id="celular" required></label>
                <br>
                <label>Estado: <br><select name="estado" id="estado" required>
                    <option value="">Selecione um estado</option>
                    <?php
                        $buscaEstado = mysqli_query($con, "SELECT id_estado, nome_estado FROM tb_estados");
                        while($estados = mysqli_fetch_object($buscaEstado)){
                            echo "<option value=".$estados->id_estado.">".$estados->nome_estado."</option>";
                        }
                    ?>
                </select></label>
                <br>            
                <label>Cidade: <br><select name="cidade" id="cidade" required <?php if(mysqli_fetch_object($buscaEstado) == ""): echo"disabled"; endif;?>>
                    <option value="">---Selecione---</option>
                </select></label>
                <br>
                <label>Pai empresarial: <br><select name="pai_empresarial" id="pai_empresarial">
                    <option value="">--Selecione--</option>
                    <?php
                        $buscaPai = mysqli_query($con, "SELECT id_empresario, nome_completo FROM tb_empresarios");
                        while($empresarios = mysqli_fetch_object($buscaPai)){
                            echo "<option value=".$empresarios->id_empresario.">".$empresarios->nome_completo."</option>";
                        }
                    ?>
                </select></label>
                <br>
                <button id="adcEmpresario" onclick="cadastrar();" type="submit">Adicionar Empresário</button>
            </form>
        </div>
    </div>
    <br>
    <div class="total">
        <div class="center1">
            <table>
                <tr class="cabecalho">
                    <th>Nome completo</th>
                    <th>Celular</th>
                    <th>Cidade / UF</th>
                    <th>Data do cadastro</th>
                    <th>Pai empresarial</th>
                    <th>Ação</th>
                </tr>
                
                <?php
        
                    $checkRecord = mysqli_query($con,"SELECT * FROM tb_empresarios");
                    $totalrows = mysqli_num_rows($checkRecord);
        
                    if ($totalrows == 0){
                        echo "<tr>
                            <td colspan='7'> Não há empresários cadastrados</td>
                        <tr>";
                    } else {
                        
                        $empresarios = mysqli_query($con, "SELECT `tb_empresarios`.`id_empresario`, `tb_empresarios`.`nome_completo`, `tb_empresarios`.`celular`, `tb_empresarios`.`cadastrado_em`, `tb_cidades`.`nome_cidade`, `tb_estados`.`uf`, `M`.`nome_completo` AS `pai` FROM `tb_empresarios` INNER JOIN `tb_cidades` ON `tb_cidades`.`id_cidade` = `tb_empresarios`.`cidade` INNER JOIN `tb_estados` ON `tb_estados`.`id_estado` = `tb_cidades`.`id_estado_tb_cidades` LEFT JOIN `tb_empresarios` `M` ON `tb_empresarios`.`pai_empresarial` = `M`.`id_empresario` ORDER BY `tb_empresarios`.`cadastrado_em` DESC");
                        while($empresario = mysqli_fetch_object($empresarios)){
                            echo    "<tr id='".$empresario->id_empresario."' class='linhas'>
                                        <td>$empresario->nome_completo</td>
                                        <td>$empresario->celular</td>
                                        <td>$empresario->nome_cidade / $empresario->uf</td>
                                        <td>$empresario->cadastrado_em</td>
                                        <td>$empresario->pai</td>
                                        <td><button value='".$empresario->id_empresario."' class='del'>Excluir</button></td>
                                    </tr>";
                        }
                        mysqli_close($con);
                    }
                ?>
            </table>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
    
</body>
</html>