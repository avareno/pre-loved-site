<?php
session_start(); // Start the session
require '../../database/read_tables.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];

    }
    // Check if any field is empty
    if (empty($username) || empty($password)) {
        echo 'Fill all the fields to register';
    } else {
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            if (password_verify($password, $user['password'])) {

                $_SESSION['username'] = $username;
                header("location: index.php");
                exit;
            } else {
                $login_err = 'Invalid password';
            }
        } else {
            $login_err = 'Username not found';
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <h2>Registration Form</h2>
    <form method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
        <?php if (isset($login_err)) { ?>
            <p class="error"><?php echo $login_err; ?></p>
        <?php } ?>
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>

</html>