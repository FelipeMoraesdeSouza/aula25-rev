<?php
include "menu.php";
$idfornec = isset($_GET["idfornec"]) ? $_GET["idfornec"]:null;
$op = isset($_GET["op"])? $_GET["op"]:null;
try{
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdrevisao";
    $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha);

  if($op=="del"){
    $sql = "delete from tblfornec where idfornec= :idfornec";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(":idfornec",$idfornec);
    $stmt->execute();
    header("Location:fornecedores.php");
  }
  if($idfornec){
    $sql = "Select *  from tblfornec where idfornec= :idfornec";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(":idfornec",$idfornec);
    $stmt->execute();
    $fornec = $stmt->fetch(PDO::FETCH_OBJ);

  }



  if($_POST){
    if($_POST["idfornec"]){
      $sql = "UPDATE tblfornec set fornecedor=:fornecedor, cnpj=:cnpj,tell=:tell WHERE idfornec=:idfornec";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":fornecedor", $_POST["fornecedor"]);
      $stmt->bindValue(":cnpj", $_POST["cnpj"]);
      $stmt->bindValue(":tell", $_POST["tell"]);
      $stmt->bindValue(":idfornec", $_POST["idfornec"]);
      $stmt->execute();
    } else {
      $sql = "INSERT INTO tblfornec(fornecedor,cnpj,tell) values(:fornecedor,:cnpj,:tell)";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(":fornecedor",$_POST["fornecedor"]);
      $stmt->bindValue(":cnpj",$_POST["cnpj"]);
      $stmt->bindValue(":tell",$_POST["tell"]);
      
      $stmt->execute();
      


    }
    header("Location:fornecedores.php");
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
    <h1>Cadastro de fornecedor</h1>    
    <hr>
    <div class="container">
        <form method="post">
            fornecedor       <input type="text" name="fornecedor"    value="<?php echo isset($fornec) ? $fornec->fornecedor:null ?>">
            CNPJ             <input type="text" name="cnpj"          value="<?php echo isset($fornec) ? $fornec->cnpj:null ?>">
            Telefone         <input type="text" name="tell"          value="<?php echo isset($fornec) ? $fornec->tell:null ?>">
            <input type="hidden" name="idfornec"                     value="<?php echo isset($fornec) ? $fornec->idfornec:null ?>">>
            <input type="submit" value="Cadastrar" class="btn btn-warning">

        </form>
    </div>
  
  <?php 
    
    include "rodape.php";
    ?>
