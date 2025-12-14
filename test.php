<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>System Health Check</h1>";

// 1. Check File Structure
echo "<h2>1. Checking File Structure...</h2>";
$required_files = [
    'config.php',
    'functions.php',
    'css/style.css',
    'includes/header.php',
    'includes/footer.php',
    'booking.php',
    'guest-details.php',
    'confirmation.php'
];

foreach ($required_files as $file) {
    if (file_exists($file)) {
        echo "<p style='color:green'>[OK] Found: $file</p>";
    } else {
        echo "<p style='color:red'>[ERROR] Missing: $file</p>";
    }
}

// 2. Check Database Connection
echo "<h2>2. Checking Database...</h2>";
if (file_exists('config.php')) {
    include 'config.php';
    if (isset($pdo)) {
        echo "<p style='color:green'>[OK] Database Connected Successfully!</p>";
        
        // 3. Check Tables
        echo "<h3>Checking Tables:</h3>";
        $tables = ['admin_users', 'rooms', 'bookings'];
        foreach ($tables as $table) {
            try {
                $result = $pdo->query("SELECT 1 FROM $table LIMIT 1");
                echo "<p style='color:green'>[OK] Table '$table' exists.</p>";
            } catch (PDOException $e) {
                echo "<p style='color:red'>[ERROR] Table '$table' NOT found. Did you run db_setup.sql?</p>";
            }
        }

    } else {
        echo "<p style='color:red'>[ERROR] \$pdo variable not set in config.php.</p>";
    }
} else {
    echo "<p style='color:red'>[ERROR] config.php not found, cannot check database.</p>";
}

// 4. Check Session
echo "<h2>3. Checking Sessions...</h2>";
if (session_status() === PHP_SESSION_ACTIVE) {
    echo "<p style='color:green'>[OK] Sessions are working.</p>";
} else {
    echo "<p style='color:orange'>[WARNING] Session not started automatically.</p>";
}
?>