<?php
session_start(); // Inicia a sessão
require '../../database/read_tables.php'; // Include only once at the beginning
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
if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
    // Obtém o product_id enviado pelo formulário
    $product_id = $_POST['product_id'];

    // Aumenta a quantidade do produto para 1 quando removido do carrinho
    $queryIncreaseQuantity = $db->prepare('UPDATE products SET quantity = 1 WHERE id = :product_id');
    $queryIncreaseQuantity->bindValue(':product_id', $product_id, PDO::PARAM_INT);
    $queryIncreaseQuantity->execute();

    // Remove o produto do carrinho na tabela shopping_cart
    $queryRemoveFromCart = $db->prepare('DELETE FROM shopping_cart WHERE user_id = :user_id AND product_id = :product_id');
    $queryRemoveFromCart->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $queryRemoveFromCart->bindValue(':product_id', $product_id, PDO::PARAM_INT);
    $queryRemoveFromCart->execute();

    // Redireciona de volta para a página do carrinho
    header("Location: cart.php");
    exit;
} else {
    // Se o product_id não foi enviado, retorna um status de erro
    http_response_code(400);
    echo json_encode(array("message" => "Bad Request"));
    exit;
}
?>
