<?php
    require_once 'rota/init.php';
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
        <center><h1 class="title">CRIAÇÃO DO CONTATO</h1></center>
        <br>

        <form method="post" action="<?= APP  ?>cliente.php">
            <br>
            <br>
            <div class="col-md-12">
                <div class="form-group row">
                    <!-- <label for="nome" class="col-4 col-form-label">Nome</label> -->
                    <div class="col-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">NOME</div>
                            </div>
                            <input id="nome" name="nome" placeholder="Ex.: João" type="text" pattern="^[A-Za-z]+$" required class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <!-- <label for="sobrenome" class="col-4 col-form-label">Sobrenome</label> -->
                    <div class="col-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">SOBRENOME</div>
                            </div>
                            <input id="sobrenome" name="sobrenome" placeholder="Ex.: Santos Silva" type="text" pattern="^[A-Za-z\s]+$" required class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <!-- <label for="email" class="col-4 col-form-label">Email</label> -->
                    <div class="col-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">EMAIL</div>
                            </div>
                            <input id="email" name="email" placeholder="example@example.com" type="email" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <!-- <label for="telefone" class="col-4 col-form-label">Telefone</label> -->
                    <div class="col-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">TELEFONE</div>
                            </div>
                            <input id="telefone" name="telefone" placeholder="Ex.: 11999999999" type="text" pattern="\d{11}" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <center><button name="submit" type="submit" class="btn btn-success">Gravar</button></center>
            <center><a href="<?= APP  ?>index.php" class="btn btn-secondary">Voltar</a></center>
            <input type="hidden" name="acao" value="novo" >
        </form>

    </div>
</body>

</html>