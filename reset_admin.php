<?php
include 'config.php';

$username = 'admin';
$password = 'admin123';
// Generate a correct BCRYPT hash for "admin123"
$hash = password_hash($password, PASSWORD_DEFAULT);

try {
    // Check if admin exists
    $stmt = $pdo->prepare("SELECT id FROM admin_users WHERE username = ?");
    $stmt->execute([$username]);
    
    if ($stmt->rowCount() > 0) {
        // Update existing user
        $sql = "UPDATE admin_users SET password = ? WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$hash, $username]);
        echo "<h2 style='color:green'>Success!</h2><p>Password reset. You can now login with:<br>User: <b>admin</b><br>Pass: <b>admin123</b></p>";
    } else {
        // Create new user if missing
        $sql = "INSERT INTO admin_users (username, password) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $hash]);
        echo "<h2 style='color:green'>Success!</h2><p>Admin user created.<br>User: <b>admin</b><br>Pass: <b>admin123</b></p>";
    }
    echo "<a href='admin/login.php'>Go to Login</a>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>