<?php
// Get current file name to highlight active menu item
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- Admin Header -->
<header class="header" style="background: rgba(10, 10, 10, 0.85); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(0, 255, 136, 0.15); position: fixed; width: 100%; top: 0; z-index: 1000;">
    <div class="container">
        <nav class="navbar" style="display: flex; justify-content: space-between; align-items: center; padding: 15px 0;">
            
            <!-- Logo Area -->
            <a href="dashboard.php" class="logo-main" style="text-decoration: none; display: flex; align-items: center; gap: 12px;">
                <div style="background: rgba(0, 255, 136, 0.1); padding: 8px; border-radius: 8px; border: 1px solid #00ff88;">
                    <i class="fas fa-hotel" style="color: #00ff88; font-size: 1.2rem;"></i>
                </div>
                <div style="display: flex; flex-direction: column; line-height: 1.1;">
                    <span style="font-size: 1.4rem; font-weight: 700; color: #fff; letter-spacing: 1px;">LUXSTAY</span>
                    <span style="font-size: 0.7rem; color: #00ff88; letter-spacing: 3px; font-weight: 500;">ADMINISTRATION</span>
                </div>
            </a>

            <!-- Navigation Links -->
            <div class="nav-links" style="display: flex; align-items: center; gap: 30px;">
                
                <a href="dashboard.php" class="nav-link" 
                   style="display: flex; align-items: center; gap: 8px; font-size: 0.9rem; font-weight: 500; text-transform: uppercase; text-decoration: none; transition: all 0.3s ease; 
                   <?php echo ($current_page == 'dashboard.php') ? 'color: #00ff88; text-shadow: 0 0 10px rgba(0,255,136,0.3);' : 'color: #b0b0b0;'; ?>">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>

                <a href="bookings.php" class="nav-link" 
                   style="display: flex; align-items: center; gap: 8px; font-size: 0.9rem; font-weight: 500; text-transform: uppercase; text-decoration: none; transition: all 0.3s ease;
                   <?php echo ($current_page == 'bookings.php') ? 'color: #00ff88; text-shadow: 0 0 10px rgba(0,255,136,0.3);' : 'color: #b0b0b0;'; ?>">
                    <i class="fas fa-calendar-check"></i> Bookings
                </a>

                <a href="rooms.php" class="nav-link" 
                   style="display: flex; align-items: center; gap: 8px; font-size: 0.9rem; font-weight: 500; text-transform: uppercase; text-decoration: none; transition: all 0.3s ease;
                   <?php echo ($current_page == 'rooms.php') ? 'color: #00ff88; text-shadow: 0 0 10px rgba(0,255,136,0.3);' : 'color: #b0b0b0;'; ?>">
                    <i class="fas fa-bed"></i> Rooms
                </a>

                <!-- Distinct Logout Button -->
                <a href="logout.php" class="btn-book" 
                   style="margin-left: 15px; background: rgba(255, 77, 77, 0.1); border: 1px solid rgba(255, 77, 77, 0.5); color: #ff6b6b; padding: 8px 24px; border-radius: 50px; font-size: 0.85rem; display: flex; align-items: center; gap: 8px; transition: all 0.3s ease; text-decoration: none;">
                    <span>Logout</span> <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </nav>
    </div>
</header>