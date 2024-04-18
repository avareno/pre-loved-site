<?php
$db = new PDO('sqlite:database.db'); 

$stmt = $db->prepare('Select * from products ');
$stmt->execute();
$products = $stmt->fetchAll();

$rows = 0; // Initialize $rows variable

if(isset($_POST['find'])){
    $key = $_POST['key'];
    $query = $db->prepare('Select title FROM products where title Like :keyword order by title');

    $query->bindValue(':keyword' ,'%'.$key.'%',PDO::PARAM_STR);
    $query->execute(); // Execute the query
    $results = $query->fetchAll(); // Fetch results
    
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
    <link rel="stylesheet" href="style.css">
</head>
<header>
    <ul class="topnav">
        <li><img src="https://upload.wikimedia.org/wikipedia/commons/1/1f/The_IMG_Media_broadcasting_company_logo.png"></li>
        <li><a class="active" href="#home">Home</a></li>
        <li class="right">
            <form method="post" action="">
                <input type="text" placeholder="Search.." name="key">
                <input type="submit" value="find" name="find">
            </form>
        </li>
        <li><a href="filtered_page.php">News</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
</header>
<body>
<?php
  if(!empty($results)){//error in the verification
      foreach($results as $r){
          echo '<h4>'.$r['title'].'</h4>';
      }
  } else {
      echo 'No result found';
  }
?>
</body>
</html>
