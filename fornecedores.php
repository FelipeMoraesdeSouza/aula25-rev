<?php
include "conexao.php";
include "menu.php";

try{
    $sql = "SELECT * FROM tblfornec";
    $qry = $con->query($sql);
    $fornecedors = $qry->fetchALL(PDO::FETCH_OBJ);

    //echo "<pre>";
    //    print_r($fornecdors);
       
} catch(PDOException $e){
    echo $e->getMessage();
}


?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Sistema</title>
  </head>
  <body>
    <h1>Fornecedores Cadastrados</h1>
<hr>

<div class="container">
    <a href="frmfornec.php" class="btn btn-primary">Novo</a>
    <table class="table table-success table-striped table-hover">
        <thead>
            <tr>
                <th>id fornecedor</th>
                <th>fonecedor</th>
                <th>cnpj</th>
                <th>telefone</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($fornecedors as $fornec) { ?>
            <tr>
                <th><?php echo $fornec->idfornec ?></th>
                <th><?php echo $fornec->fornecedor ?></th>
                <th><?php echo $fornec->cnpj ?></th>
                <th><?php echo $fornec->tell ?></th>
                 
                <th>
                    <a href="frmfornec.php?idfornec=<?php echo $fornec->idfornec ?> ">
                    
                    <img src="./img/editar.png" alt="">
                </a>
                </th>

                <th>
                    <a href="frmfornec.php?op=del&idfornec=<?php echo $fornec->idfornec ?> ">
                   
                    <img src="./img/excluir.png" alt="">
                </a>
                </th>
 
            </tr>
            <?php } ?>
            </tbody>
           

    </table>
</div>

    <?php 
    
    include "rodape.php";
    ?>