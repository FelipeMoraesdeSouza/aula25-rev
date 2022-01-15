<?php
include "menu.php";
$idproduto = isset($_GET["idproduto"]) ? $_GET["idproduto"]:null;
$op = isset($_GET["op"])? $_GET["op"]:null;
try{
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdrevisao";
    $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha);

  if($op=="del"){
    $sql = "delete from tblprodutos where idproduto= :idproduto";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(":idproduto",$idproduto);
    $stmt->execute();
    header("Location:produtos.php");
  }
  if($idproduto){
    $sql = "Select *  from tblprodutos where idproduto= :idproduto";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(":idproduto",$idproduto);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_OBJ);

  }



  if($_POST){
    if($_POST["idproduto"]){
      $sql = "UPDATE tblprodutos set produto=:produto, qtd=:qtd,preco=:preco WHERE idproduto=:idproduto";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":produto", $_POST["produto"]);
      $stmt->bindValue(":qtd", $_POST["qtd"]);
      $stmt->bindValue(":preco", $_POST["preco"]);
      $stmt->bindValue(":idproduto", $_POST["idproduto"]);
      $stmt->execute();
    } else {
      $sql = "INSERT INTO tblprodutos(produto,qtd,preco) values(:produto,:qtd,:preco)";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":produto",$_POST["produto"]);
      $stmt->bindValue(":qtd",$_POST["qtd"]);
      $stmt->bindValue(":preco",$_POST["preco"]);
      
      $stmt->execute();
      


    }
    header("Location:produtos.php");
  }




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
    <h1>Cadastro de produto</h1>    
    <hr>
    <div class="container">
        <form method="post">
            Produto       <input type="text" name="produto" value="<?php echo isset($produto) ? $produto->produto:null ?>">
            Quantidade    <input type="text" name="qtd"     value="<?php echo isset($produto) ? $produto->qtd:null ?>">
            Preço         <input type="text" name="preco"   value="<?php echo isset($produto) ? $produto->preco:null ?>">
            <input type="hidden" name="idproduto"           value="<?php echo isset($produto) ? $produto->idproduto:null ?>">>
            <input type="submit" value="Cadastrar" class="btn btn-warning">

        </form>
    </div>
  
  <?php 
    
    include "rodape.php";
    ?>
