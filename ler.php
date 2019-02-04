<?php
	require 'conexao.php';
	if ($_GET)
    $id_pessoa = (isset($_GET['id'])) ? $_GET['id'] : '';
    if ($_POST)
	$id_pessoa = (isset($_POST['id'])) ? $_POST['id'] : '';
	
	$consulta = $connect->prepare('SELECT * FROM Pessoas WHERE ID = :id');
    $consulta->bindValue(':id', $id_pessoa);
    $consulta->execute();
	$pessoa = $consulta->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadstro de Pessoas</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
        .container {
            width: 100vw;
            height: 40vh;
            display: flex;
            justify-content: center;
            align-items: center
            }
            .box {
            width: 500px;
            height: 100%;
            }
            body {
            margin: 0px;
            }
    </style>
</head>
<body>
    <div class="container">
        <div class="box">
            <h3>Cadastro de pessoas</h3>
            <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>email</th>
                      <th>ação</th>
                    </tr>
                  </thead>
                  <tbody>
            <div>
            <?php
                    echo '<tr>';
                     echo '<td>'. $pessoa->Email . '</td>';
                     echo '<td width=250>';
                    echo '<a class="btn" href="read.php?id='.$pessoa->ID.'">Ler</a>';
                    echo ' ';
                    echo '<a class="btn btn-success" href="editar.php?id='.$pessoa->ID.'">Editar</a>';
                    echo ' ';
                    echo '<a class="btn btn-danger" href="delete.php?id='.$pessoa->ID.'">Excluir</a>';
                    echo '</tr>';
                
    ?>
    </tbody>
            </table>
</div>
        </div>
    </div>
</body>
</html>