<?php 
include 'config.php';
include 'functions.php'; // Contains the fixed get_available_rooms
include 'includes/header.php'; 

// Initialize variables
$check_in = isset($_GET['check_in']) ? $_GET['check_in'] : date('Y-m-d');
$check_out = isset($_GET['check_out']) ? $_GET['check_out'] : date('Y-m-d', strtotime('+1 day'));
$guests = isset($_GET['guests']) ? $_GET['guests'] : 2;

// Get available rooms using the function from functions.php
$available_rooms = get_available_rooms($check_in, $check_out, $pdo);
?>

<div class="booking-hero">
    <div class="container">
        <div class="booking-hero-content">
            <h1>Find Your Sanctuary</h1>
            <p>Select your dates to discover our available luxury suites</p>
        </div>
    </div>
</div>

<section class="search-section">
    <div class="container">
        <div class="search-card">
            <form action="booking.php" method="GET" class="search-form">
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-calendar-check"></i> Check-in</label>
                        <input type="date" name="check_in" value="<?php echo $check_in; ?>" min="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-calendar-times"></i> Check-out</label>
                        <input type="date" name="check_out" value="<?php echo $check_out; ?>" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-user-friends"></i> Guests</label>
                        <select name="guests">
                            <option value="1" <?php echo $guests == 1 ? 'selected' : ''; ?>>1 Guest</option>
                            <option value="2" <?php echo $guests == 2 ? 'selected' : ''; ?>>2 Guests</option>
                            <option value="3" <?php echo $guests == 3 ? 'selected' : ''; ?>>3 Guests</option>
                            <option value="4" <?php echo $guests == 4 ? 'selected' : ''; ?>>4 Guests</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-search">
                        Update Search <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="results-section">
    <div class="container">
        <div class="results-header">
            <h2>Available Rooms</h2>
            <p>Showing availability for <?php echo count($available_rooms); ?> rooms</p>
        </div>

        <?php if (empty($available_rooms)): ?>
            <div class="empty-state">
                <div class="empty-icon"><i class="fas fa-calendar-times"></i></div>
                <h3>No Rooms Available</h3>
                <p>We apologize, but we are fully booked for these dates. Please try selecting different dates.</p>
            </div>
        <?php else: ?>
            <div class="rooms-grid">
                <?php foreach ($available_rooms as $room): ?>
                <div class="room-card">
                    <div class="room-image">
                        <!-- Handle Image Fallback -->
                        <?php $img = !empty($room['image_url']) ? $room['image_url'] : 'https://images.unsplash.com/photo-1611892440504-42a792e24d32'; ?>
                        <img src="<?php echo $img; ?>" alt="<?php echo $room['room_type']; ?>">
                        <div class="room-badge"><?php echo $room['room_type']; ?></div>
                        
                        <!-- Overlay with Book Button -->
                        <div class="room-overlay">
                            <form action="guest-details.php" method="POST">
                                <input type="hidden" name="room_id" value="<?php echo $room['id']; ?>">
                                <input type="hidden" name="check_in" value="<?php echo $check_in; ?>">
                                <input type="hidden" name="check_out" value="<?php echo $check_out; ?>">
                                <input type="hidden" name="guests" value="<?php echo $guests; ?>">
                                <button type="submit" class="btn-view-details">
                                    Book This Room <i class="fas fa-arrow-right"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="room-content">
                        <div class="room-header">
                            <h3><?php echo $room['room_type']; ?> <small style="font-size:0.8rem; color:#666;">(#<?php echo $room['room_number']; ?>)</small></h3>
                            <div class="room-rating">
                                <i class="fas fa-star"></i> 5.0
                            </div>
                        </div>
                        <p class="room-description"><?php echo $room['description']; ?></p>
                        
                        <div class="room-features">
                            <div class="feature"><i class="fas fa-wifi"></i> Free Wifi</div>
                            <div class="feature"><i class="fas fa-coffee"></i> Breakfast</div>
                            <div class="feature"><i class="fas fa-tv"></i> Smart TV</div>
                        </div>
                        
                        <div class="room-pricing">
                            <div class="price-info">
                                <div class="nightly-rate">
                                    <span class="price">$<?php echo $room['price']; ?></span>
                                    <span class="period">/ night</span>
                                </div>
                            </div>
                            <!-- Mobile Book Button -->
                            <form action="guest-details.php" method="POST">
                                <input type="hidden" name="room_id" value="<?php echo $room['id']; ?>">
                                <input type="hidden" name="check_in" value="<?php echo $check_in; ?>">
                                <input type="hidden" name="check_out" value="<?php echo $check_out; ?>">
                                <input type="hidden" name="guests" value="<?php echo $guests; ?>">
                                <button type="submit" class="btn-book-now">
                                    Select Room
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>