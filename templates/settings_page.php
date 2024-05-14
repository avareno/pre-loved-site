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
    <section>
        <section class="settings-container">
            <section class="vertical-navbar">
                <ul>
                    <li><a href="#" onclick="showSection('profile-settings')">Profile Settings</a></li>
                    <li><a href="#" onclick="showSection('account-settings')">Account Settings</a></li>
                    <li><a href="#" onclick="showSection('payment-methods')">Payment Methods</a></li>
                </ul>
            </section>

            <section class="content-section">
                <section id="profile-settings" class="section active">
                    <!-- Profile Settings Section -->
                    <h2>Profile Settings</h2>

                    <section class="row">
                        <section class="column">
                            <h4>Foto:</h4>
                            <section>
                                <img id="profile-image" src="<?php echo $row['image']; ?>" alt="Profile Image">
                            </section>
                            <section>
                                <form method="post" enctype="multipart/form-data">
                                    <input type="file" name="profile-image" id="profile-image-input" accept="image/*"
                                        style="display: none;" onchange="this.form.submit()">
                                    <button class="submit-button" type="button"
                                        onclick="document.getElementById('profile-image-input').click();">Change
                                        Image</button>
                                </form>
                            </section>
                        </section>
                        <section class="column">
                            <h4>Small Description:</h4>
                            <form method="post">
                                <textarea name="small_description" id="small_description" rows="10" cols="30"
                                    maxlength="255"><?php echo $row['small_description']; ?></textarea>
                                <button class="submit-button" type="submit">Change Description</button>
                            </form>
                        </section>
                        <section class="column">
                            <h4>Country:</h4>
                            <section>
                                <form method="post">
                                    <input type="text" name="country" id="country" value="<?php echo $row['country']; ?>">
                                    <button class="submit-button" type="submit">Change Country</button>
                                </form>
                            </section>
                        </section>
                        <section class="column">
                            <h4>City:</h4>
                            <form method="post">
                                <input type="text" name="city" id="city" value="<?php echo $row['city']; ?>">
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
                            <section>
                                <form method="post">
                                    <input type="text" name="email" id="email" value="<?php echo $row['email']; ?>">
                                    <button class="submit-button" type="submit">Change Email</button>
                                </form>
                            </section>
                        </section>
                        <section class="column">
                            <h4>Phone Number:</h4>
                            <form method="post">
                                <input type="text" name="phone_number" id="phone_number"
                                    value="<?php echo $row['phone_number']; ?>">
                                <button class="submit-button" type="submit">Change Phone Number</button>
                            </form>
                        </section>
                        <section class="column">
                            <?php if (!$is_seller && !$is_admin) { ?>

                                <h4>Become Seller:</h4>
                                <label class="switch">
                                  <input type="checkbox">
                                  <span class="slider round"></span>
                                </label>
                            <?php } else if ($is_seller) { ?>
                                    <h4>Become User:</h4>
                                    <label class="switch">
                                      <input type="checkbox">
                                      <span class="slider round"></span>
                                    </label>
                            <?php } ?>
                        </section>
                    </section>
                </section>

                <section id="payment-methods" class="section">
                    <h2>Payment Methods</h2>
                </section>
            </section>
        </section>
    </section>
    <?php
}
?>