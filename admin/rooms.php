<?php
include '../config.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Handle Room Status Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_room'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $stmt = $pdo->prepare("UPDATE rooms SET status = ? WHERE id = ?");
    $stmt->execute([$status, $id]);
    $message = "Room Updated Successfully";
}

$rooms = $pdo->query("SELECT * FROM rooms ORDER BY room_number ASC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Rooms</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .admin-table { width: 100%; border-collapse: collapse; background: #1a1a1a; border-radius: 10px; overflow: hidden; }
        .admin-table th { background: #222; color: #00ff88; padding: 15px; text-align: left; text-transform: uppercase; font-size: 0.9rem; letter-spacing: 1px; }
        .admin-table td { padding: 15px; border-bottom: 1px solid #333; color: #fff; vertical-align: middle; }
        .admin-table tr:last-child td { border-bottom: none; }
        .status-select { background: #000; color: #fff; border: 1px solid #444; padding: 8px; border-radius: 5px; width: 100%; outline: none; cursor: pointer; }
        .status-select:focus { border-color: #00ff88; }
        .room-type-badge { background: rgba(255,255,255,0.1); padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; color: #ccc; }
        
        .status-dot { display: inline-block; width: 10px; height: 10px; border-radius: 50%; margin-right: 8px; }
        .dot-available { background: #00ff88; box-shadow: 0 0 5px #00ff88; }
        .dot-booked { background: #ff4d4d; box-shadow: 0 0 5px #ff4d4d; }
        .dot-cleaning { background: #00ccff; box-shadow: 0 0 5px #00ccff; }
        .dot-maintenance { background: #666; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container" style="padding-top: 150px; padding-bottom: 50px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="color: #fff; margin: 0;">Room Management</h2>
            <?php if(isset($message)): ?>
                <span style="color: #00ff88; background: rgba(0,255,136,0.1); padding: 5px 15px; border-radius: 5px;"><?php echo $message; ?></span>
            <?php endif; ?>
        </div>

        <div style="overflow-x: auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Room</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Current Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rooms as $r): ?>
                    <tr>
                        <td>
                            <strong style="font-size: 1.2rem;"><?php echo $r['room_number']; ?></strong>
                        </td>
                        <td>
                            <span class="room-type-badge"><?php echo $r['room_type']; ?></span>
                        </td>
                        <td style="color: #00ff88;">$<?php echo $r['price']; ?></td>
                        
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
                            <td>
                                <select name="status" class="status-select">
                                    <option value="available" <?php if($r['status'] == 'available') echo 'selected'; ?>>Available</option>
                                    <option value="booked" <?php if($r['status'] == 'booked') echo 'selected'; ?>>Booked</option>
                                    <option value="cleaning" <?php if($r['status'] == 'cleaning') echo 'selected'; ?>>Cleaning</option>
                                    <option value="maintenance" <?php if($r['status'] == 'maintenance') echo 'selected'; ?>>Maintenance</option>
                                </select>
                            </td>
                            <td>
                                <button type="submit" name="update_room" class="btn-book" style="padding: 8px 20px; font-size: 0.9rem; border: none; cursor: pointer;">
                                    Update
                                </button>
                            </td>
                        </form>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>