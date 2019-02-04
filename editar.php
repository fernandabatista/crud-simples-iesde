<?php
	require 'conexao.php';
	if ($_GET)
    $id_pessoa = (isset($_GET['id'])) ? $_GET['id'] : '';
    if ($_POST)
	$id_pessoa = (isset($_POST['id'])) ? $_POST['id'] : '';
		
    
	if(isset($_POST['update'])) {
		$errMsg = '';

		// Getting data from FROM
		$nome = $_POST['nome'];
		$senha = $_POST['senha'];
		$csenha = $_POST['csenha'];
		$estado = $_POST['estado'];
		$cidade = $_POST['cidade'];
		$id_pessoa = $_POST['id'];
		
		if($senha != $csenha)
		$errMsg = 'as senhas não conferem';
		if($nome == '')
			$errMsg = 'Todos os Campos devem ser preenchidos!';
		if($senha == '')
			$errMsg = 'Todos os Camppos devem ser preenchidos!';
		if($estado == '')
			$errMsg = 'Todos os Camppos devem ser preenchidos!';
		if($cidade == '')
			$errMsg = 'Todos os Campos devem ser preenchidos!';
		


		if($errMsg == '') {
		    
			try {
			    $stmt = $connect->prepare('UPDATE Pessoas SET Nome = :nome, Senha = :senha, Estado = :estado, Cidade = :cidade WHERE ID = :id');
				$stmt->execute(array(
					':nome' => $nome,
					':senha' => $senha,
					':estado' => $estado,
					':cidade' => $cidade,
					':id' => $id_pessoa
					));
				//header('Location: editar.php?action=updated&id=id');
				//exit;
				$errMsg =  'Pessoa Atualizada!';

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
<form action="editar.php" method="post">
    <div class="form-group">
      <label for="nome">Nome</label>
			<input type="text" name="nome" placeholder="Nome" value="<?=$pessoa->Nome?>" autocomplete="off" class="form-control"/><br /><br />
    </div>
  <div class="form-group">
    <label for="email">Email</label>
		<input type="email" name="email" placeholder="Email" value="<?=$pessoa->Email?>" autocomplete="off" class="form-control"/><br /><br />
  </div>
  <div class="form-row">
<div class="form-group col-md-6">
<label for="senha">Senha</label>
<input type="password" name="senha" placeholder="senha" value="<?=$pessoa->Senha?>" class="form-control" /><br/><br />
</div>
<div class="form-group col-md-6">
<label for="csenha">Confirmar Senha</label>
<input type="password" name="csenha" placeholder="senha" value="<?=$pessoa->Senha?>" class="form-control" /><br/><br />
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="estado">Estado</label>
<select class="form-control" name="estado" id="estado">
	<?php
                $consulta = $connect->query("SELECT * FROM Estados;");
                 
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
								echo "<option value=" . $linha["EstadoID"] . ">" . $linha["Sigla"] . " - " . $linha["Descricao"] . "</option>";}
  ?>
    </select></div></div>
<div class="form-group col-md-6">
<label for="cidade">Cidade</label>
<input type="text" name="cidade" placeholder="cidade" value="<?=$pessoa->Cidade?>" autocomplete="off" class="form-control"/><br /><br />
</div>
</div>
  <div class="form-group">
    <label for="foto">Foto</label>
    <input type="file" name="foto" class="form-control-file" id="foto">
  </div>
  <input type="hidden" name="id" value="<?=$id_pessoa?>">
	<input type="submit" name='update' value="Registrar" class='submit'/><br />
</form>
			</div>
		</div>
	</div>
	</div>
	</div>
</body>
</html>
