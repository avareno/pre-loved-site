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
?>
</body>
</html>
