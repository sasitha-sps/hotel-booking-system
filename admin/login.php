<?php
include '../config.php';

// Handle Login Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify Password (admin123)
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Invalid Username or Password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background: #000;">

    <form method="POST" style="background: #1a1a1a; padding: 40px; border-radius: 10px; width: 100%; max-width: 400px; border: 1px solid #333;">
        <h2 style="color: #fff; text-align: center; margin-bottom: 30px;">Admin Login</h2>
        
        <?php if(isset($error)): ?>
            <p style="color: #ff4d4d; text-align: center; background: rgba(255, 77, 77, 0.1); padding: 10px; border-radius: 5px; margin-bottom: 20px;"><?php echo $error; ?></p>
        <?php endif; ?>

        <div style="margin-bottom: 20px;">
            <label style="color: #bbb; display: block; margin-bottom: 5px;">Username</label>
            <input type="text" name="username" required style="width: 100%; padding: 12px; background: #0a0a0a; border: 1px solid #333; color: #fff; border-radius: 5px; outline: none;">
        </div>

        <div style="margin-bottom: 30px;">
            <label style="color: #bbb; display: block; margin-bottom: 5px;">Password</label>
            <input type="password" name="password" required style="width: 100%; padding: 12px; background: #0a0a0a; border: 1px solid #333; color: #fff; border-radius: 5px; outline: none;">
        </div>

        <button type="submit" class="btn-book" style="width: 100%; cursor: pointer; border: none;">Login Dashboard</button>
    </form>

</body>
</html>