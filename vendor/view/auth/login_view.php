<?php
$pageTitle = "Login";

const BASE_URL = '/cs-312_boothlink';
$title = $pageTitle;
?>
<link rel="stylesheet" href="<?php echo BASE_URL?>../../public/css/login.css">
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
            <p>Don't have an account yet? <a href="#">Sign Up</a></p>
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
