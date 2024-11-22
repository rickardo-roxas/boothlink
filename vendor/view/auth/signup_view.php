<?php
$pageTitle = "Sign Up";

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
    <div class="grid-container">
        <div id="grid-left">
            <h1>booth<span style="color:#1EBDEF">link</span></h1>
        </div>
        <div id="grid-right">
            <form id="signup-form" action="/cs-312_boothlink/signup" method="POST">
                <div class="input-control">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" class="signup-input" name="last_name">
                    <div class="error"></div>
                </div>

                <div class="input-control">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" class="signup-input" name="first_name">
                    <div class="error"></div>
                </div>

                <div class="input-control">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="signup-input" name="email">
                    <div class="error"></div>
                </div>

                <div class="input-control">
                    <label for="username">Username</label>
                    <input type="text" id="username" class="signup-input" name="username">
                    <div class="error"></div>
                </div>

                <div class="input-control">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="signup-input" name="password">
                    <div class="error"></div>
                </div>

                <button type="submit" class="signup-button">Sign up</button>
            </form>
        </div>
    </div>
</main>