<?php
session_start(); // Inicia a sessão
require '../../../database/read_tables.php'; // Include only once at the beginning
$db = getDatabaseConnection();

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    // Redireciona para a página de login se não estiver logado
    header("Location: ../login/login.php");
    exit;
}

// Obtém o user_id da sessão
$user_id = $_SESSION['username'];

// Verifica se o product_id foi enviado pelo formulário
if (isset($_POST['product_id'])) {
    // Obtém o product_id enviado pelo formulário
    $product_id = $_POST['product_id'];

    // Insere o produto no carrinho na tabela shopping_cart
    $query = $db->prepare('INSERT INTO shopping_cart (user_id, product_id) VALUES (:user_id, :product_id)');
    $query->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $query->bindValue(':product_id', $product_id, PDO::PARAM_INT);
    $query->execute();

    // Decrementa a quantidade do produto na tabela products
    $decrementQuery = $db->prepare('UPDATE products SET quantity = 0 WHERE id = :product_id');
    $decrementQuery->bindValue(':product_id', $product_id, PDO::PARAM_INT);
    $decrementQuery->execute();

    // Redireciona de volta à página do produto com uma mensagem de sucesso
    header("Location: ../products_page/product_profile.php?id=$product_id&added_to_cart=true");
    exit;
} else {
    // Se o product_id não foi enviado, redireciona para uma página de erro
    header("Location: error.php");
    exit;
}
?>
