<?php
$pageTitle = "Sign Up";

const BASE_URL = '/cs-312_boothlink';
$title = $pageTitle;
?>
<link rel="stylesheet" href="<?php echo BASE_URL?>/vendor/public/css/signup.css">
<main>
    <div class="grid-container">
        <div id="grid-left">
            <h1>booth<span style="color:#1EBDEF">link</span></h1>
        </div>
        <div id="grid-right">
            <form id="signup-form" action="/shared/public">
                <h1>Sign up</h1>
                <p>Already have an account? <a href="" id="login-link" class="sky-blue">Log in</a></p>

                <div class="input-control">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" class="signup-input" name="Last Name">
                    <div class="error"></div>
                </div>

                <div class="input-control">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" class="signup-input" name="First Name">
                    <div class="error"></div>
                </div>

                <div class="input-control">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="signup-input" name="Email">
                    <div class="error"></div>
                </div>

                <div class="input-control">
                    <label for="username">Username</label>
                    <input type="text" id="username" class="signup-input" name="Username">
                    <div class="error"></div>
                </div>

                <div class="input-control">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="signup-input" name="Password">
                    <div class="error"></div>
                    <!--<div class="password-toggle" style="display: flex; align-items: center;">
                        <input type="checkbox" id="toggle-password" onclick="togglePassword()" style="margin-left: 10px;">
                    </div>-->
                </div>


                <button class="signup-button">Sign up</button>
            </form>
        </div>
    </div>
</main>