<?php
    include 'conn.php'; 
    
    if(isset($_GET["id_estado"])){
        $id_estado = $_GET["id_estado"];
        $buscaCidade = mysqli_query($con, "SELECT id_cidade, nome_cidade FROM tb_cidades INNER JOIN tb_estados ON tb_estados.id_estado = tb_cidades.id_estado_tb_cidades WHERE tb_cidades.id_estado_tb_cidades = $id_estado");
        $array = [];
        while($cidades = mysqli_fetch_object($buscaCidade)){
            array_push($array,["id"=>$cidades->id_cidade,"cidade"=>$cidades->nome_cidade]);
        }
        $json = json_encode($array,JSON_UNESCAPED_UNICODE);
        echo $json;
    }
    mysqli_close($con);
?>
