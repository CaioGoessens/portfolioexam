<?php
session_start();

// Change this to your own credentials
$admin_user = 'lecaiotrilogy';
$admin_pass = 'cgoessens060724';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] === $admin_user && $_POST['password'] === $admin_pass) {
        $_SESSION['logged_in'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 40px; }
        .box {
            background: white; max-width: 400px; margin: auto; padding: 30px;
            border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        input { width: 100%; padding: 10px; margin-top: 10px; border-radius: 6px; border: 1px solid #ccc; }
        button { margin-top: 20px; padding: 10px 20px; background: #42a5f5; color: white; border: none; border-radius: 6px; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Admin Login</h2>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
