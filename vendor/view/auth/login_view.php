<?php
$pageTitle = "Login";

const BASE_URL = '/cs-312_boothlink';
$title = $pageTitle;
?>
<head>
    <title>BoothLink | <?php echo $title ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BoothLink lets you discover and reserve unique products and services from student
    booths at Saint Louis University. Support SLU's vibrant student community today!">
    <title>BoothLink | <?php echo $title?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/vendor/public/css/interactive.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/vendor/public/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/vendor/public/css/login.css">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL; ?>/shared/assets/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL; ?>/shared/assets/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL; ?>/shared/assets/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="<?php echo BASE_URL; ?>/shared/assets/favicon_io/site.webmanifest">
</head>
<main>
    <div class="container">
    <!--Left section logo part-->
        <div class="left">
            <h1 class="logo">
                <span class="black">booth</span><span class="blue">link</span>
            </h1>
        </div>

        <!-- The right section(login) -->
        <div class="right">
            <h2>Log In</h2>
            <p>Don't have an account yet? <a href="/cs-312_boothlink/signup">Sign Up</a></p>
            <form action="/cs-312_boothlink/login" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="checkbox-group">
                    <label for="show-password">Show Password</label>
                    <input type="checkbox" id="show-password" onclick="togglePassword()">
                </div>
                <button type="submit">Log In</button>
            </form>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
</main>
