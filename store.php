<?php

/**
 * Inclui o arquivo de conexão com o banco de dados.
 */
require __DIR__ . "/connect.php";

/**
 * Captura os dados enviados pelo formulário via método POST.
 */
$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$document = trim($_POST["document"] ?? "");

/**
 * Validação básica:
 * se qualquer campo estiver vazio, a execução é interrompida.
 */
if ($name === "" || $email === "" || $document === "") {
    // Se cair aqui, verifique se os 'name' no index.php estão corretos!
    die("Preencha todos os campos.");
}

try {
    /**
     * Obtém a conexão com o banco.
     */
    $pdo = Connect::getInstance();

    /**
     * Prepara a instrução SQL de inserção.
     */
    $stmt = $pdo->prepare("
        INSERT INTO users (name, email, document)
        VALUES (:name, :email, :document)
    ");

    /**
     * Executa a instrução preparada.
     */
    $stmt->execute([
        ":name" => $name,
        ":email" => $email,
        ":document" => $document
    ]);

    /**
     * Redireciona o usuário para a página principal.
     */
    header("Location: index.php");
    exit;

} catch (PDOException $e) {
    // Isso vai te salvar se o erro for no banco de dados
    die("Erro no banco de dados: " . $e->getMessage());
}