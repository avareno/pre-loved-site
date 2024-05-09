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

// Obtém os detalhes dos produtos no carrinho do usuário
$query = $db->prepare('SELECT products.id, products.title FROM shopping_cart JOIN products ON shopping_cart.product_id = products.id WHERE shopping_cart.user_id = :user_id');
$query->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$query->execute();
$products = $query->fetchAll(PDO::FETCH_ASSOC);
?>


<!doctype html>
<html lang="en">

<head>
    <title>LTW</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../css/navstyle.css">
    <link rel="stylesheet" href="../../css/carousel.css">
    <link rel="stylesheet" href="../../css/container.css">
    <link rel="stylesheet" href="../../css/filters.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><img src="https://upload.wikimedia.org/wikipedia/commons/1/1f/The_IMG_Media_broadcasting_company_logo.png"></li>
                <li><a  href="../main_page/index.php">Home</a></li>
                <li><a href="filtered_page.php">News</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="right" >
                    <form method="post" action="../products_page/products.php"> 
                        <input type="submit" value="find" name="find">
                        <input type="text" placeholder="Search..." name="key">
                    </form>
                </li>
                <li class="right">
                <a href="../cart/cart.php">Cart</a>
                </li>
                <?php
                    // Check if user is already logged in
                    if(isset($_SESSION['username'])) {
                        echo '<li class="right"><a href="../profile/profile.php">Profile</a></li>';
                    } else {
                        echo '<li class="right"><a href="../login/register.php">Login/Register</a></li>';
                    }
                ?>
            </ul>
        </nav>
    </header>

    <nav id="filters-bar">
        <ul>
            <li><a href="../products_page/products.php?category=Clothing">Clothing</a></li>
            <li><a href="../products_page/products.php?category=Electronics">Electronics</a></li>
            <li><a href="../products_page/products.php?category=Sports">Sports</a></li>
            <li><a href="../products_page/products.php?category=Home%20&%20Garden">House and Garden</a></li>
            <li><a href="../products_page/products.php?category=Offers">Offers</a></li>
            <li><a href="../products_page/products.php?category=More">More</a></li>
        </ul>       
    </nav>

    <section class="grid-container">
        <h1>Carrinho de Compras</h1>
        <?php if (count($products) > 0): ?>
            <ul>
            <?php foreach ($products as $product): ?>
                <li>
                    <?php echo $product['title']; ?>
                    <form action="../cart/remove_from_cart.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" name="remove_from_cart">Remover do Carrinho</button>
                    </form>
                </li>
            <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>O seu carrinho está vazio.</p>
        <?php endif; ?>
    </section>

    
</body>

</html>
