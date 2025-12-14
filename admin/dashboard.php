<?php
include '../config.php';

// Security Check
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// --- 1. FETCH STATISTICS ---
$stats = [
    'pending' => $pdo->query("SELECT COUNT(*) FROM bookings WHERE status = 'pending'")->fetchColumn(),
    'cleaning' => $pdo->query("SELECT COUNT(*) FROM rooms WHERE status = 'cleaning'")->fetchColumn(),
    'booked'   => $pdo->query("SELECT COUNT(*) FROM rooms WHERE status = 'booked'")->fetchColumn(),
    'available'=> $pdo->query("SELECT COUNT(*) FROM rooms WHERE status = 'available'")->fetchColumn()
];

// --- 2. FETCH ALL ROOMS (For Live Status View) ---
$rooms = $pdo->query("SELECT * FROM rooms ORDER BY room_number ASC")->fetchAll(PDO::FETCH_ASSOC);

// --- 3. FETCH RECENT PENDING BOOKINGS ---
$recent_bookings = $pdo->query("SELECT * FROM bookings WHERE status = 'pending' ORDER BY created_at DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Dashboard Specific Styles */
        .dashboard-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .stat-box { background: #1a1a1a; padding: 20px; border-radius: 10px; border: 1px solid #333; text-align: center; transition: 0.3s; }
        .stat-box:hover { transform: translateY(-5px); border-color: #00ff88; }
        .stat-box h3 { font-size: 2.5rem; margin: 10px 0; color: #fff; }
        .stat-box p { color: #888; text-transform: uppercase; font-size: 0.9rem; letter-spacing: 1px; }
        
        .live-status-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 15px; }
        .status-card { padding: 15px; border-radius: 8px; text-align: center; color: #000; font-weight: bold; position: relative; }
        .status-available { background: #00ff88; }
        .status-booked { background: #ff4d4d; color: white; }
        .status-cleaning { background: #00ccff; }
        .status-maintenance { background: #666; color: white; }
        
        .dashboard-section { background: #1a1a1a; padding: 30px; border-radius: 15px; border: 1px solid #333; margin-bottom: 30px; }
        .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #333; padding-bottom: 10px; }
        .section-header h3 { color: #fff; margin: 0; }
        
        .mini-table { width: 100%; border-collapse: collapse; }
        .mini-table th { text-align: left; color: #888; padding: 10px; font-size: 0.9rem; border-bottom: 1px solid #333; }
        .mini-table td { padding: 12px 10px; color: #fff; border-bottom: 1px solid #222; }
        .btn-small { padding: 5px 10px; font-size: 0.8rem; background: #00ff88; color: #000; border-radius: 4px; text-decoration: none; display: inline-block; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <!-- Updated Padding: 150px top -->
    <div class="container" style="padding-top: 150px; padding-bottom: 50px;">
        
        <!-- 1. KEY METRICS -->
        <div class="dashboard-stats">
            <div class="stat-box" style="border-top: 3px solid #ffaa00;">
                <h3 style="color: #ffaa00;"><?php echo $stats['pending']; ?></h3>
                <p>Pending Requests</p>
            </div>
            <div class="stat-box" style="border-top: 3px solid #00ccff;">
                <h3 style="color: #00ccff;"><?php echo $stats['cleaning']; ?></h3>
                <p>Needs Cleaning</p>
            </div>
            <div class="stat-box" style="border-top: 3px solid #ff4d4d;">
                <h3 style="color: #ff4d4d;"><?php echo $stats['booked']; ?></h3>
                <p>Occupied Rooms</p>
            </div>
            <div class="stat-box" style="border-top: 3px solid #00ff88;">
                <h3 style="color: #00ff88;"><?php echo $stats['available']; ?></h3>
                <p>Available Rooms</p>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
            
            <!-- 2. RECENT REQUESTS -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h3><i class="fas fa-clock" style="color: #ffaa00;"></i> Recent Requests</h3>
                    <a href="bookings.php" style="color: #00ff88; font-size: 0.9rem;">View All</a>
                </div>
                <?php if (count($recent_bookings) > 0): ?>
                    <table class="mini-table">
                        <thead><tr><th>Guest</th><th>Ref</th><th>Date</th><th>Action</th></tr></thead>
                        <tbody>
                            <?php foreach ($recent_bookings as $rb): ?>
                            <tr>
                                <td><?php echo $rb['guest_name']; ?></td>
                                <td style="color: #00ff88;"><?php echo $rb['booking_ref']; ?></td>
                                <td><?php echo $rb['check_in']; ?></td>
                                <td><a href="bookings.php" class="btn-small">Review</a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p style="color: #666; text-align: center; padding: 20px;">No pending requests.</p>
                <?php endif; ?>
            </div>

            <!-- 3. LIVE ROOM STATUS -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h3><i class="fas fa-th" style="color: #fff;"></i> Room Status</h3>
                    <a href="rooms.php" style="color: #00ff88; font-size: 0.9rem;">Update</a>
                </div>
                
                <div class="live-status-grid">
                    <?php foreach ($rooms as $room): ?>
                        <div class="status-card status-<?php echo $room['status']; ?>">
                            <?php echo $room['room_number']; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div style="margin-top: 20px; display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; font-size: 0.8rem; color: #bbb;">
                    <span style="display: flex; align-items: center; gap: 5px;"><span style="width: 10px; height: 10px; background: #00ff88; border-radius: 50%;"></span> Available</span>
                    <span style="display: flex; align-items: center; gap: 5px;"><span style="width: 10px; height: 10px; background: #ff4d4d; border-radius: 50%;"></span> Booked</span>
                    <span style="display: flex; align-items: center; gap: 5px;"><span style="width: 10px; height: 10px; background: #00ccff; border-radius: 50%;"></span> Cleaning</span>
                </div>
            </div>

        </div>
    </div>
    
    <style>
        @media (max-width: 900px) {
            div[style*="grid-template-columns: 2fr 1fr"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</body>
</html>