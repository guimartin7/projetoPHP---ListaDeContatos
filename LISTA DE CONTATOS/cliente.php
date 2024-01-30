<?php   
    require_once 'rota/init.php';

    // Pega dados do formulário
    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $sobrenome = isset($_POST['sobrenome']) ? $_POST['sobrenome'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    // Valida para evitar dados vazios
    if (!empty($_POST['acao']) && (empty($nome) || empty($sobrenome))) {
        echo "Preencha os campos Nome e Sobrenome";
        exit;
    }

    $PDO = connectDB();

    if (isset($_POST['acao']) && $_POST['acao'] == 'novo') {
        try {
            // Insere no banco
            $sql = "INSERT INTO contatos (nome, sobrenome, email, telefone) VALUES (:nome, :sobrenome, :email, :telefone)";
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':sobrenome', $sobrenome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefone', $telefone);

            if ($stmt->execute()) {
                header('Location: ' . APP . 'index.php');
            } else {
                echo "Erro ao cadastrar";
                print_r($stmt->errorInfo());
            }
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') { // Código para violação de restrição UNIQUE
                echo "<script>alert('E-mail/telefone já cadastrado. Por favor, valide!');</script>";
            } else {
                echo "Erro ao cadastrar: " . $e->getMessage();
            }
        }
    } elseif (isset($_POST['acao']) && $_POST['acao'] == 'edita') {
        try {
            // Atualiza o registro no banco mesmo com duplicidades
            $sql = "UPDATE contatos SET nome = :nome, sobrenome = :sobrenome, email = :email, telefone = :telefone WHERE id = :id";
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':sobrenome', $sobrenome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                header('Location: ' . APP . 'index.php');
            } else {
                echo "Erro ao alterar";
                print_r($stmt->errorInfo());
            }
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') { // Código para violação de restrição UNIQUE
                echo "<script>alert('E-mail/telefone já cadastrado. Por favor, valide!');</script>";
            } else {
                echo "Erro ao alterar: " . $e->getMessage();
            }
        }
    } elseif (isset($_GET['acao']) && $_GET['acao'] == 'deletar') {
        $id  = isset($_GET['id']) ? $_GET['id'] : null;
        // Valida o ID
        if (empty($id)) {
            echo "ID não informado";
            exit;
        }

        try {
            // Remove do banco
            $sql = "DELETE FROM contatos WHERE id = :id";
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                header('Location: ' . APP . 'index.php');
            } else {
                echo "Erro ao remover";
                print_r($stmt->errorInfo());
            }
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') { // Código para violação de restrição UNIQUE
                echo "<script>alert('Não é possível remover o registro. E-mail/telefone já cadastrado.');</script>";
            } else {
                echo "Erro ao remover: " . $e->getMessage();
            }
        }
    }
?>
