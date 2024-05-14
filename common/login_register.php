<?php function fetch_head($for,$type,$id,$name,$title,$is_register,$login_err){?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../../css/login.css">
</head>
<body>
    <h2>Registration Form</h2>
    <form method="post">
        <?php for ($i = 0; $i < count($for); $i++) { ?>
            <label for="<?php echo $for[$i]; ?>"><?php echo $title[$i]; ?></label><br>
            <input type="<?php echo $type[$i]; ?>" id="<?php echo $id[$i]; ?>" name="<?php echo $name[$i]; ?>" required><br><br>
        <?php } ?>
        <input type="submit" value="Register">

        <?php if($is_register){ ?>
        <?php if (isset($login_err)) { ?>
            <p class="error"><?php echo $login_err; ?></p>
        <?php } ?>
    </form>
    <p>Already have an account? <a href="login.php">Log in here</a></p>
    <?php } else{?>
            <?php if (isset($login_err)) { ?>
                <p class="error"><?php echo $login_err; ?></p>
            <?php } ?>
        </form>

        <p>Don't have an account? <a href="register.php">Register here</a></p>
        <?php } ?>
</body>
<?php
}
?>