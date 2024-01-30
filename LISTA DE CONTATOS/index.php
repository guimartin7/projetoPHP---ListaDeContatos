<?php
	// configurações
	require_once 'rota/init.php';

	// conexão com o banco de dados
	$db = connectDB();

	// Inicializar a variável de pesquisa
	$pesquisa = '';

	// Verificar se o formulário de pesquisa foi enviado
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    $pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : '';
	}
	
	// Montar a consulta SQL com base na pesquisa
	$sql = "SELECT * FROM contatos WHERE nome LIKE :pesquisa OR sobrenome LIKE :pesquisa ORDER BY nome ASC";

	//Seleciona os registros
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':pesquisa', '%' . $pesquisa . '%', PDO::PARAM_STR);
	$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Lista de Contatos</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="estilo.css" media="screen">
</head>

<body>
	<div class="container">
		<h1 class="title">Listagem de contatos</h1>
		<br>
		<a href="<?= APP  ?>cliente-new.php" class="btn btn-primary">Novo</a>
		<br><br>

		<!-- Formulário de Pesquisa -->
		<form method="POST">
			<div class="form-group">
				<!-- <label for="pesquisa">Pesquisar por Nome ou Sobrenome:</label> -->
				<input type="text" placeholder="Nome ou Sobrenome" name="pesquisa" id="pesquisa" class="form-control" value="<?= $pesquisa ?>">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Pesquisar</button>
				<button type="button" class="btn btn-secondary" onclick="limparPesquisa()">Limpar</button>
			</div>
		</form>
		<br>

		<div class="col-md-12">
			<table class="table">
				<tr>
					<th>NOME</th>
					<th>SOBRENOME</th>
					<th>AÇÕES</th>
				</tr>
				<?php
					while ($cli = $stmt->fetch(PDO::FETCH_ASSOC)) :
				?>
				<tr>
					<th><?= $cli['nome'] ?></th>
					<th><?= $cli['sobrenome'] ?></th>
					<th>
					<a href="<?= APP ?>cliente-view.php/?id=<?= $cli['id'] ?>" class="btn btn-info btn-sm" style="border: 1px solid black;">Visualizar</a><br>
       				<a href="<?= APP ?>cliente-edit.php/?id=<?= $cli['id'] ?>" class="btn btn-warning btn-sm" style="border: 1px solid black;">Editar</a><br>
        			<a href="<?= APP ?>cliente.php/?acao=deletar&id=<?= $cli['id'] ?>" class="btn btn-danger btn-sm" style="border: 1px solid black;">Excluir</a>
					</th>
				</tr>
				<?php
					endwhile;
				?>
			</table>
		</div>
	</div>
	<script>
		function limparPesquisa() {
			document.getElementById("pesquisa").value = "";
		}
	</script>
</body>
</html>
