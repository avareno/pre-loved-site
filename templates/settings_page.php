<?php
function draw_settings_page($username, $is_admin, $is_seller, $row)
{
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="stylesheet" href="../../../css/settings.css">
        <link rel="stylesheet" href="../../../css/dashboard.css">
        <link rel="stylesheet" href="../../../css/container.css">
        <script src="../../../js/change_link.js" defer></script>
    </head>

    <body>
        <main class="settings-container">
            <nav class="vertical-navbar">
                <ul>
                    <li><a href="#" onclick="showSection('profile-settings')">Profile Settings</a></li>
                    <li><a href="#" onclick="showSection('account-settings')">Account Settings</a></li>
                </ul>
            </nav>

            <section class="content-section">
                <section id="profile-settings" class="section active">
                    <h2>Profile Settings</h2>
                    <section class="row">
                        <section class="column">
                            <h4>Foto:</h4>
                            <section class="profile-image-container">
                                <img id="profile-image" src="<?php echo htmlspecialchars($row['image']); ?>"
                                    alt="Profile Image">
                            </section>
                            <section>
                                <form method="post" action="../../actions/add_info_user.php" enctype="multipart/form-data">
                                    <input type="file" name="profile-image" id="profile-image-input" style="display: none;"
                                        onchange="this.form.submit()">
                                    <button class="submit-button" type="button"
                                        onclick="document.getElementById('profile-image-input').click();">Change
                                        Image</button>
                                </form>
                            </section>
                        </section>
                        <section class="column">
                            <h4>Small Description:</h4>
                            <form method="post" action="../../actions/add_info_user.php">
                                <textarea name="small_description" id="small_description" rows="5"
                                    maxlength="255"><?php echo htmlspecialchars($row['small_description']); ?></textarea>
                                <button class="submit-button" type="submit">Change Description</button>
                            </form>
                        </section>
                        <section class="column">
                            <h4>Country:</h4>
                            <form method="post" action="../../actions/add_info_user.php">
                                <input type="text" name="country" id="country"
                                    value="<?php echo htmlspecialchars($row['country']); ?>">
                                <button class="submit-button" type="submit">Change Country</button>
                            </form>
                        </section>
                        <section class="column">
                            <h4>City:</h4>
                            <form method="post" action="../../actions/add_info_user.php">
                                <input type="text" name="city" id="city"
                                    value="<?php echo htmlspecialchars($row['city']); ?>">
                                <button class="submit-button" type="submit">Change City</button>
                            </form>
                        </section>
                    </section>
                </section>

                <section id="account-settings" class="section">
                    <h2>Account Settings</h2>
                    <section class="row">
                        <section class="column">
                            <h4>Email:</h4>
                            <form method="post" action="../../actions/add_info_user.php">
                                <input type="text" name="email" id="email"
                                    value="<?php echo htmlspecialchars($row['email']); ?>">
                                <button class="submit-button" type="submit">Change Email</button>
                            </form>
                        </section>
                        <section class="column">
                            <h4>Phone Number:</h4>
                            <form method="post" action="../../actions/add_info_user.php">
                                <input type="text" name="phone_number" id="phone_number"
                                    value="<?php echo htmlspecialchars($row['phone_number']); ?>">
                                <button class="submit-button" type="submit">Change Phone Number</button>
                            </form>
                        </section>
                        <section class="column">
                            <h4>Change Password</h4>
                            <form method="post" action="../../actions/change_password.php">
                                <label for="current_password">Current Password:</label>
                                <input type="password" name="current_password" id="current_password" required>
                                <label for="new_password">New Password:</label>
                                <input type="password" name="new_password" id="new_password" required>
                                <label for="new_password_conf">Confirm New Password:</label>
                                <input type="password" name="new_password_conf" id="new_password_conf" required>
                                <button class="submit-button" type="submit">Change Password</button>
                            </form>
                        </section>

                    </section>
                </section>

            </section>
        </main>
    </body>

    </html>
    <?php
}
?>