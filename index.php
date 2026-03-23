<?php

/**
 * Inclui o arquivo de conexão com o banco de dados.
 */
require __DIR__ . "/connect.php";

/**
 * Obtém a instância da conexão com o banco.
 */
$pdo = Connect::getInstance();

/**
 * Executa uma consulta SQL para buscar todos os usuários.
 */
$stmt = $pdo->query("SELECT * FROM users ORDER BY id ASC");

/**
 * fetchAll() busca todos os registros.
 */
$users = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIAENE | Gestão de Alunos</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="main-header">
        <div class="header-container">
            <h1 class="logo">UNIAENE</h1>
            <nav class="main-nav">
                <ul>
                    <li><a href="#lista">Alunos Cadastrados</a></li>
                    <li><a href="https://github.com/UNIAENE-GTI/CRUD" target="_blank" class="btn-shop">Portal</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero-faixa-azul">
            <div class="faixa-content">
                <span class="num-destaque">001</span>
                <h2 class="title">MATRÍCULA DE ALUNOS</h2>
                <p class="subtitle">SISTEMA DE GESTÃO ACADÊMICA V.1.0</p>
            </div>
        </section>

        <section class="enrollment-section">
            <div class="form-wrapper">
                
                <form action="store.php" method="post" class="enrollment-form">
                    <div class="form-header">
                        <span class="step-num">01</span>
                        <h3>NOVO CADASTRO</h3>
                    </div>
                    
                    <div class="form-fields">
                        <div class="input-group">
                            <label>Nome:</label>
                            <input type="text" name="name" required placeholder="Nome do aluno">
                        </div>

                        <div class="input-group">
                            <label>E-mail:</label>
                            <input type="email" name="email" required placeholder="email@exemplo.com">
                        </div>

                        <div class="input-group">
                            <label>Curso:</label>
                            <input type="text" name="document" required placeholder="Nome do curso">
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">
                        CADASTRAR <span>→</span>
                    </button>
                </form>
            </div>

            <div class="lab-hand-visual">
            </div>
        </section>

        <section id="lista" class="list-section">
            <div class="list-container">
                <div class="list-header">
                    <h2>LISTA DE ALUNOS <span><?= count($users) ?></span></h2>
                </div>

                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Curso</th>
                            <th>Cadastrado em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td class="td-id"><?= $user["id"] ?></td>
                                <td class="td-name"><?= $user["name"] ?></td>
                                <td><?= $user["email"] ?></td>
                                <td><span class="badge-curso"><?= $user["document"] ?></span></td>
                                <td><?= date("d/m/Y H:i", strtotime($user["created_at"])) ?></td>
                                <td class="td-actions">
                                    <a href="edit.php?id=<?= $user["id"] ?>" class="btn-edit">Editar</a> |
                                    <a href="delete.php?id=<?= $user["id"] ?>" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este aluno?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    </table>
            </div>
        </section>
    </main>

    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

</body>
</html>