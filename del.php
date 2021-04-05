<?php
    include 'conn.php'; 

    $id = $_POST['id'];

    if($id > 0){

        $checkRecord = mysqli_query($con,"SELECT * FROM tb_empresarios WHERE id_empresario=".$id);
        $totalrows = mysqli_num_rows($checkRecord);
      
        if($totalrows > 0){
          $query = "DELETE FROM tb_empresarios WHERE id_empresario=".$id;
          mysqli_query($con,$query);
          echo "<script>alert('SUCESSO! \nEmpresario foi excluído com sucesso!');</script>";
          exit;
        }
      }

    mysqli_close($con);
?>