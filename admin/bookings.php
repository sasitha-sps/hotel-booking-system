<?php
include '../config.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Handle Updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    
    if (isset($_POST['update_status'])) {
        $status = $_POST['status'];
        $stmt = $pdo->prepare("UPDATE bookings SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
        
        // Auto-update room status logic
        if ($status == 'checked_in') {
            $room_stmt = $pdo->prepare("UPDATE rooms SET status = 'booked' WHERE id = (SELECT room_id FROM bookings WHERE id = ?)");
            $room_stmt->execute([$id]);
        } elseif ($status == 'checked_out') {
            $room_stmt = $pdo->prepare("UPDATE rooms SET status = 'cleaning' WHERE id = (SELECT room_id FROM bookings WHERE id = ?)");
            $room_stmt->execute([$id]);
        }
    }
    
    if (isset($_POST['update_payment'])) {
        $payment = $_POST['payment'];
        $stmt = $pdo->prepare("UPDATE bookings SET payment_status = ? WHERE id = ?");
        $stmt->execute([$payment, $id]);
    }
}

// Fetch Bookings
$bookings = $pdo->query("SELECT b.*, r.room_number, r.room_type 
                         FROM bookings b 
                         JOIN rooms r ON b.room_id = r.id 
                         ORDER BY b.created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .admin-table { width: 100%; border-collapse: collapse; background: #1a1a1a; border-radius: 10px; overflow: hidden; white-space: nowrap; }
        .admin-table th { background: #222; color: #00ff88; padding: 15px; text-align: left; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px; }
        .admin-table td { padding: 15px; border-bottom: 1px solid #333; color: #ddd; vertical-align: middle; }
        
        .whatsapp-btn { background: #25D366; color: white; padding: 5px 10px; border-radius: 4px; text-decoration: none; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 5px; }
        .whatsapp-btn:hover { background: #128C7E; }
        
        .admin-select { background: #000; color: #fff; border: 1px solid #444; padding: 6px; border-radius: 4px; font-size: 0.9rem; cursor: pointer; outline: none; }
        .admin-select:focus { border-color: #00ff88; }
        
        .btn-update { background: none; border: 1px solid #00ff88; color: #00ff88; padding: 5px 10px; border-radius: 4px; cursor: pointer; transition: 0.3s; }
        .btn-update:hover { background: #00ff88; color: #000; }
        
        /* Status Highlights */
        .row-pending { border-left: 4px solid #ffaa00; }
        .row-confirmed { border-left: 4px solid #00ff88; }
        .row-cancelled { border-left: 4px solid #ff4d4d; opacity: 0.6; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <!-- Updated Padding: 150px top -->
    <div class="container" style="padding-top: 150px; padding-bottom: 50px;">
        <h2 style="color: #fff; margin-bottom: 20px;">Booking Management</h2>

        <div style="overflow-x: auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Ref</th>
                        <th>Guest Info</th>
                        <th>Room</th>
                        <th>Timeline</th>
                        <th>Payment</th>
                        <th>Booking Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($bookings as $b): 
                        $status_class = 'row-' . $b['status'];
                    ?>
                    <tr class="<?php echo $status_class; ?>">
                        <td style="color: #00ff88; font-weight: bold;"><?php echo $b['booking_ref']; ?></td>
                        
                        <td>
                            <strong style="color: #fff; display:block; margin-bottom:5px;"><?php echo $b['guest_name']; ?></strong>
                            <a href="https://wa.me/<?php echo str_replace(['+',' '], '', $b['guest_whatsapp']); ?>" target="_blank" class="whatsapp-btn">
                                <i class="fab fa-whatsapp"></i> Chat
                            </a>
                        </td>
                        
                        <td>
                            <span style="color: #fff; font-size: 1.1rem;"><?php echo $b['room_number']; ?></span><br>
                            <small style="color: #888;"><?php echo $b['room_type']; ?></small>
                        </td>
                        
                        <td>
                            <div style="color: #ccc; font-size: 0.9rem;">
                                In: <span style="color: #fff;"><?php echo $b['check_in']; ?></span><br>
                                Out: <span style="color: #fff;"><?php echo $b['check_out']; ?></span>
                            </div>
                        </td>

                        <!-- Payment Status -->
                        <td>
                            <form method="POST" style="display: flex; gap: 5px;">
                                <input type="hidden" name="id" value="<?php echo $b['id']; ?>">
                                <select name="payment" class="admin-select" style="border-color: <?php echo ($b['payment_status'] == 'paid') ? '#00ff88' : '#ffaa00'; ?>">
                                    <option value="pending" <?php if($b['payment_status'] == 'pending') echo 'selected'; ?>>Pending</option>
                                    <option value="paid" <?php if($b['payment_status'] == 'paid') echo 'selected'; ?>>PAID</option>
                                </select>
                                <button type="submit" name="update_payment" class="btn-update"><i class="fas fa-check"></i></button>
                            </form>
                        </td>

                        <!-- Booking Status -->
                        <td>
                            <form method="POST" style="display: flex; gap: 5px;">
                                <input type="hidden" name="id" value="<?php echo $b['id']; ?>">
                                <select name="status" class="admin-select">
                                    <option value="pending" <?php if($b['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                                    <option value="confirmed" <?php if($b['status'] == 'confirmed') echo 'selected'; ?>>Confirmed</option>
                                    <option value="checked_in" <?php if($b['status'] == 'checked_in') echo 'selected'; ?>>Checked In</option>
                                    <option value="checked_out" <?php if($b['status'] == 'checked_out') echo 'selected'; ?>>Checked Out</option>
                                    <option value="cancelled" <?php if($b['status'] == 'cancelled') echo 'selected'; ?>>Cancelled</option>
                                </select>
                                <button type="submit" name="update_status" class="btn-update">Save</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>