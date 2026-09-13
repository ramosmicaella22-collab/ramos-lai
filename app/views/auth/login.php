<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <p style="color:red;"><?= $_SESSION['error'] ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="/authenticate" method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>