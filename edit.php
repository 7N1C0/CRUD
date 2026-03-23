<?php

/**
 * Inclui o arquivo de conexão com o banco de dados.
 */
require __DIR__ . "/connect.php";

/**
 * Captura o parâmetro "id" enviado pela URL e valida.
 */
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("ID inválido.");
}

/**
 * Obtém a conexão com o banco de dados.
 */
$pdo = Connect::getInstance();

/**
 * Prepara a consulta SQL para buscar apenas um usuário.
 */
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
$stmt->execute([":id" => $id]);
$user = $stmt->fetch();

if (!$user) {
    die("Aluno não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIAENE | Editar Aluno</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="main-header">
        <div class="header-container">
            <h1 class="logo">UNIAENE</h1>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">Voltar para a Lista</a></li>
                    <li><a href="https://github.com/UNIAENE-GTI/CRUD" target="_blank" class="btn-shop">Portal</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero-faixa-azul">
            <div class="faixa-content">
                <h2 class="title">ATUALIZAR CADASTRO</h2>
            </div>
        </section>

        <section class="enrollment-section">
            <div class="form-wrapper">
                
                <form action="update.php" method="post" class="enrollment-form">
                    <input type="hidden" name="id" value="<?= $user["id"] ?>">

                    <div class="form-header">
                        <span class="step-num">02</span>
                        <h3>EDITAR INFORMAÇÕES</h3>
                    </div>
                    
                    <div class="form-fields">
                        <div class="input-group">
                            <label>Nome:</label>
                            <input type="text" name="name" value="<?= htmlspecialchars($user["name"]) ?>" required placeholder="Nome do aluno">
                        </div>

                        <div class="input-group">
                            <label>E-mail:</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($user["email"]) ?>" required placeholder="email@exemplo.com">
                        </div>

                        <div class="input-group">
                            <label>Curso:</label>
                            <input type="text" name="document" value="<?= htmlspecialchars($user["document"]) ?>" required placeholder="Nome do curso">
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">
                        SALVAR ALTERAÇÕES <span>→</span>
                    </button>

                    <a href="index.php" style="display: block; text-align: center; margin-top: 15px; text-decoration: none; color: #666; font-size: 0.8rem; font-family: 'Roboto Mono';">
                        Cancelar e voltar
                    </a>
                </form>
            </div>
        </section>
    </main>

    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

</body>

</html>