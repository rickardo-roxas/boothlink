<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
   
</head>
<body>
    <h2>Login</h2>
    <form action="index.php" method="POST">
        <label for="username">Username or Email:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>

    <?php
    // Display error message if login fails
    if (isset($_GET['error'])) {
        echo "<p style='color:red;'>Invalid username or password.</p>";
    }
    ?>
</body>
</html>
