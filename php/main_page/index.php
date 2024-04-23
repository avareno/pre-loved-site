<?php
// require 'readdb_php';
require '../../database/readdb.php';

if(isset($_POST['find'])){
    $key = $_POST['key'];
    $query = $db->prepare('Select title FROM products where title Like :keyword order by title');

    $query->bindValue(':keyword' ,'%'.$key.'%',PDO::PARAM_STR);
    $query->execute(); // Execute the query
    $results = $query->fetchAll(); // Fetch results
    
}

if(isset($_GET['category'])) {
    $category = $_GET['category'];
    
    // Prepare and execute SQL query to fetch products of the selected category
    $query = $db->prepare('SELECT * FROM products WHERE category = :category');
    $query->bindValue(':category', $category, PDO::PARAM_STR);
    $query->execute(); // Execute the query
    $products = $query->fetchAll(); // Fetch products
    
    $rows = $query->rowCount(); // Get the row count
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>LTW</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="navstyle.css">
</head>
<header>
  <nav>
    <ul>
        <li><img src="https://upload.wikimedia.org/wikipedia/commons/1/1f/The_IMG_Media_broadcasting_company_logo.png"></li>
        <li><a class="active" href="#home">Home</a></li>
        <li><a href="filtered_page.php">News</a></li>
        <li><a href="#contact">Contact</a></li>
        <li class="right">
            <form method="post" action="">
                <input type="submit" value="find" name="find">
                <input type="text" placeholder="Search..." name="key">
            </form>
        </li>
    </ul>
</nav>
</header>
<body>
<nav id="filters-bar">
    <ul>
    <li><a href="?category=Clothing">Clothing</a></li>
        <li><a href="?category=Electronics">Electronics</a></li>
        <li><a href="?category=Sports">Sports</a></li>
        <li><a href="?category=Home%20&%20Garden">House and Garden</a></li>
        <li><a href="?category=Offers">Offers</a></li>
        <li><a href="?category=More">More</a></li>
    </ul>
  </nav>
    </nav>
<?php
  if(!empty($results)){//error in the verification
      foreach($results as $r){
          echo '<h4 style = "border: 1px solid red">'.$r['title'].'</h4>';
?>
<!-- 
    <section>

    <img src="https://source.unsplash.com/random/200x200?sig=1" />


    </section> -->
  <?php      }
  } else {
      echo 'No result found';
  }
  if(!empty($products)){//error in the verification
    foreach($products as $products){
        echo '<h4>'.$products['title'].'</h4>';
    }
} else {
    echo 'No result found';
}
?>
</body>
</html>
