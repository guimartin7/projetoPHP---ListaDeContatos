<?php
    require_once 'rota/init.php';
    if (empty($_GET["id"])) {
        header("Location: ".APP."index.php");
    }

    $db = connectDB();
    // Prepara a query de listagem
    $stmt = $db->prepare("SELECT * FROM contatos WHERE id = :id ORDER BY nome ASC");
    // Atribui ao valor ficticio :id o valor real que vem do get
    $stmt->bindParam(":id", $_GET["id"]);
    // Executa a query
    $stmt->execute();

    // armazena o resultado do banco na variavel
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="page_estilo.css" media="screen">
</head>

<body>
    <div class="container">
        <h1 class="title">Visualização do Contato</h1>
        <br>

        <form method="post" action="<?= APP  ?>cliente.php">
            <a href="<?= APP  ?>index.php" class="btn btn-secondary">Voltar</a>
            <br>
            <br>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="nome" class="col-4 col-form-label">Nome</label>
                    <div class="col-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">*</div>
                            </div>
                            <input id="nome" name="nome" type="text" value="<?= $user['nome'] ?>" required="required" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sobrenome" class="col-4 col-form-label">Sobrenome</label>
                    <div class="col-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">*</div>
                            </div>
                            <input id="sobrenome" name="sobrenome" type="text" value="<?= $user['sobrenome'] ?>" required="required" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-4 col-form-label">Email</label>
                    <div class="col-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">*</div>
                            </div>
                            <input id="email" name="email" type="text" value="<?= $user['email'] ?>" required="required" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="telefone" class="col-4 col-form-label">Telefone</label>
                    <div class="col-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">*</div>
                            </div>
                            <input id="telefone" name="telefone" type="text" value="<?= $user['telefone'] ?>" required="required" class="form-control" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</body>

</html>