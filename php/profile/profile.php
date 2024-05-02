<?php
session_start();

require '../../database/read_tables.php';
$db = getDatabaseConnection();

$username = $_SESSION['username'];

// Fetch user information including the profile image URL from the database
$query = "SELECT * FROM users WHERE username = :username";
$stmt = $db->prepare($query);
$stmt->bindParam(":username", $username);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../css/dashboard.css"> <!-- Replace with your CSS file -->
</head>

<body>
    <header>
        <h1>Welcome to Your Dashboard, <?php echo $username; ?>!</h1>
        <nav>
            <ul>
                <li><a href="../main_page/index.php">Home</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="../logout/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <section>
                <img src="<?php echo $row['image']; ?>" alt="Profile Image">
            </section>

            <section>
                <p>Username: <?php echo $username; ?></p>
                <p>Email: <?php echo $row['email']; ?></p>

            </section>
        </section>
        <section>
            <h2>Dashboard Overview</h2>
            <p>This is your default dashboard page. You can customize it as per your requirements.</p>
        </section>
    </main>
    <footer>
        <p>© <?php echo date("Y"); ?> Your Company Name. All rights reserved.</p>
    </footer>
</body>

</html>