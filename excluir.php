<?php
	require 'conexao.php';
	if ($_GET)
    $id_pessoa = (isset($_GET['id'])) ? $_GET['id'] : '';
    if ($_POST)
	$id_pessoa = (isset($_POST['id'])) ? $_POST['id'] : '';
		
    
	if(isset($_POST['excluir'])) {
		$errMsg = '';
		$id_pessoa = $_POST['id'];

		if($errMsg == '') {
		    
			try {
				$stmt = $connect->prepare('DELETE FROM Pessoas WHERE ID = :id');
			    $stmt->bindValue(':id', $id_pessoa);
			    $stmt->execute(array(
					':id' => $id_pessoa
					));
					$errMsg =  $id_pessoa . ' excuida';
					echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...</div> ";
				echo "<meta http-equiv=refresh content='1;URL=index.php'>";
				//header('Location: index.php');
				//exit;
				

			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}
	}
	
	$consulta = $connect->prepare('SELECT * FROM Pessoas WHERE ID = :id');
    $consulta->bindValue(':id', $id_pessoa);
    $consulta->execute();
	$pessoa = $consulta->fetch(PDO::FETCH_OBJ);

		
?>

<html>
<head>
    <title>Register</title>
      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
	<style>
	.container {
	   width: 100vw;
	   height: 100vh;
	   background: #6C7A89;
	   display: flex;
	   flex-direction: row;
	   justify-content: center;
	   align-items: center
	}
	.box {
		   width: 500px;
		   height: 100%;
		   background: #fff;
	}
	body {
		  margin: 0px;
	}
	</style>
<body>
	<div align="center">
		<div class="container">
			<div class="box">
		<div>
			<?php
				if(isset($errMsg)){
					echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
				}
			?>
			<div style="background-color:#006D9C; color:#FFFFFF; padding:10px;"><b>Inserir</b></div>
			<div style="margin: 15px">
				<div class="alert alert-danger" role="alert">
                Tem certeza que deseja <b>EXCLUIR</b> <?=$pessoa->Nome?>?</div>
<form action="excluir.php" method="post">
    <div class="form-group">
    	<input type="hidden" name="acao" value="excluir">
				    <input type="hidden" name="id" value="<?=$id_pessoa?>">
	<input type="submit" name='excluir' value="Excluir" class='submit'/><br />
	</div>
</form>
			</div>
		</div>
	</div>
	</div>
	</div>
</body>
</html>
