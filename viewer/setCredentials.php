<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Set Credentials</title>
</head>
<body>
    <h2>Set Credentials</h2>

    <form action="../controller/adminController.php" method="POST">
        <input type="hidden" name="userId" value="<?php echo $_POST['id']; ?>"> <!-- Get user ID from the previous form -->

        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit" name="setCredentials" value="Add">
    </form>
</body>
</html>