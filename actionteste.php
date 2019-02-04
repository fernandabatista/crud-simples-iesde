<?php
include 'conexao.php';

if (isset($_POST['cadastrar'])) {
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $email= $_POST["email"];
    $senha = $_POST["senha"];
    $estado = $_POST["estado"];
    $cidade = $_POST["cidade"];
    
    	if($nome == '')
			$errMsg = 'Enter your fullname';
		if($sobrenome == '')
			$errMsg = 'Enter username';
		if($email == '')
			$errMsg = 'Enter password';
		if($senha == '')
			$errMsg = 'Enter a sercret pin number';
		if($estado == '')
			$errMsg = 'Enter a nivel';
		if($cidade == '')
			$errMsg = 'Enter a cidade';

    if (!empty($nome) && !empty($sobrenome) && !empty($email) && !empty($senha) && !empty($estado) && !empty($cidade)) {

        try {
			$stmt = $connect->prepare('INSERT INTO Pessoas (Nome, Sobrenome, Email, Senha, EstadoID, Cidade) values (:nome, :sobrenome, :email, :senha, :estado, :cidade)');
            $stmt->execute(array(
					':nome' => $nome,
					':sobrenome' => $sobrenome,
					':email' => $email,
					':senha' => $senha,
					':estado' => $estado,
					':cidade' => $cidade
					));
				header('Location: index.php');
				exit;

            echo "<script>window.location.href = 'index.php'</script>";
        } catch (Exception $ex) {
            echo "<script>alert('Houve um erro ao cadastrar a nova Pessoa!!! Erro: ')</script>";
            echo "<script>window.location.href = 'teste.php'</script>";
        }
    } else {
        echo "<script>alert('Preencha todos os campos para cadastrar uma Pessoa!!!')</script>";
        echo "<script>window.location.href = 'addPessoa.php'</script>";
    }
}
?>