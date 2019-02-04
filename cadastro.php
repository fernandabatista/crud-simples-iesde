<?php
	require 'conexao.php';

	if(isset($_POST['registrar'])) {
		$errMsg = '';

		// Get data from FROM
		$nome = $_POST['nome'];
		$senha = $_POST['senha'];
		$csenha = $_POST['csenha'];
		$email = $_POST['email'];
		$estado = $_POST['estado'];
		$cidade = $_POST['cidade'];

		if ($senha != $csenha)
		$errMsg = 'As senhas não conferem';
		if($nome == '')
			$errMsg = 'Todos os Camppos devem ser preenchidos!';
		if($senha == '')
			$errMsg = 'Todos os Camppos devem ser preenchidos!';
		if($email == '')
			$errMsg = 'Todos os Camppos devem ser preenchidos!';
		if($estado == '')
			$errMsg = 'Todos os Camppos devem ser preenchidos!';
		if($cidade == '')
			$errMsg = 'Todos os Camppos devem ser preenchidos!';
		if($errMsg == ''){
			try {
				$stmt = $connect->prepare('INSERT INTO Pessoas (nome, senha, email, estado, cidade) VALUES (:nome, :senha, :email, :estado, :cidade)');
				$stmt->execute(array(
					':nome' => $nome,
					':senha' => $senha,
					':email' => $email,
					':estado' => $estado,
					':cidade' => $cidade
					));
				header('Location: cadastro.php?action=joined');
				exit;
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'joined') {
		$errMsg = 'Registration successfull. Now you can <a href="login.php">login</a>';
	}
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
				<form action="cadastro.php" method="post">
    <div class="form-group">
      <label for="nome">Nome</label>
			<input type="text" name="nome" placeholder="Nome" value="<?php if(isset($_POST['nome'])) echo $_POST['nome'] ?>" autocomplete="off" class="form-control"/><br /><br />
    </div>
  <div class="form-group">
    <label for="email">Email</label>
		<input type="email" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" autocomplete="off" class="form-control"/><br /><br />
  </div>
  <div class="form-row">
<div class="form-group col-md-6">
<label for="senha">Senha</label>
<input type="password" name="senha" placeholder="senha" value="<?php if(isset($_POST['senha'])) echo $_POST['senha'] ?>" class="form-control" /><br/><br />
</div>
<div class="form-group col-md-6">
<label for="csenha">Confirmar Senha</label>
<input type="password" name="csenha" placeholder="senha" value="<?php if(isset($_POST['senha'])) echo $_POST['senha'] ?>" class="form-control" /><br/><br />
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
    </select></div>
<div class="form-group col-md-6">
<label for="cidade">Cidade</label>
<input type="text" name="cidade" placeholder="cidade" value="<?php if(isset($_POST['cidade'])) echo $_POST['cidade'] ?>" autocomplete="off" class="form-control"/><br /><br />
</div>
</div>
  <div class="form-group">
    <label for="foto">Foto</label>
    <input type="file" name="foto" class="form-control-file" id="foto">
  </div>
	<input type="submit" name='registrar' value="Registrar" class='submit'/><br />
</form>
			</div>
		</div>
	</div>
	</div>
	</div>
</body>
</html>
