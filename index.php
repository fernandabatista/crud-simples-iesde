<?php
	require 'conexao.php';
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
            <a class="btn btn-info" href="cadastro.php" role="button">Cadastrar</a><a class="btn btn-warning" href="pesquisa.php" role="button">Pesquisar</a>
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
                $consulta = $connect->query("SELECT email, ID FROM Pessoas;");
                 
                foreach ($consulta as $key => $value) {
                    echo '<tr>';
                     echo '<td>'. $value['email'] . '</td>';
                     echo '<td width=250>';
                    echo '<a class="btn" href="read.php?id='.$value['ID'].'">Ler</a>';
                    echo ' ';
                    echo '<a class="btn btn-success" href="editar.php?id='.$value['ID'].'">Editar</a>';
                    echo ' ';
                    echo '<a class="btn btn-danger" href="delete.php?id='.$value['ID'].'">Excluir</a>';
                    echo '</tr>';
                }
    ?>
    </tbody>
            </table>
</div>
        </div>
    </div>
</body>
</html>