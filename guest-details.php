<?php
session_start();
include 'config.php';
include __DIR__ . '/functions.php';

// 1. Check if room is selected
if (!isset($_POST['room_id'])) { 
    header('Location: booking.php'); 
    exit(); 
}

$room_id = $_POST['room_id'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$guests = $_POST['guests'];

// 2. Get Room Details
$stmt = $pdo->prepare("SELECT * FROM rooms WHERE id = ?");
$stmt->execute([$room_id]);
$room = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$room) die("Room Error");

// 3. Handle Booking Submission
if (isset($_POST['confirm'])) {
    $ref = 'BK-' . strtoupper(uniqid());
    $days = (new DateTime($check_in))->diff(new DateTime($check_out))->days;
    $total = $room['price'] * $days;

    try {
        $sql = "INSERT INTO bookings (
            booking_ref, room_id, check_in, check_out, guests, total_amount, 
            guest_name, guest_email, guest_phone, guest_whatsapp, guest_nic, 
            guest_address, guest_city, guest_country, payment_method, status
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'pending')";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $ref, $room_id, $check_in, $check_out, $guests, $total, 
            sanitize_input($_POST['name']), 
            sanitize_input($_POST['email']), 
            sanitize_input($_POST['phone']), 
            sanitize_input($_POST['whatsapp']), 
            sanitize_input($_POST['nic']), 
            sanitize_input($_POST['address']), 
            sanitize_input($_POST['city']), 
            sanitize_input($_POST['country']), 
            sanitize_input($_POST['payment'])
        ]);
        
        $_SESSION['ref'] = $ref;
        header("Location: confirmation.php");
        exit();
    } catch (PDOException $e) {
        $error = "System Error: " . $e->getMessage();
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="container guest-details-container" style="padding-top: 100px; padding-bottom: 100px; min-height: 80vh;">
    <h2 style="color:#fff; text-align:center; margin-bottom:40px; font-size: 2.5rem;">Finalize Your Reservation</h2>
    
    <div class="content-grid">
        
        <!-- LEFT: Guest Form -->
        <div class="guest-form-section">
            <?php if(isset($error)): ?>
                <div style="background: rgba(255, 0, 0, 0.2); border: 1px solid red; color: #ff6b6b; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <!-- Hidden Data -->
                <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
                <input type="hidden" name="check_in" value="<?php echo $check_in; ?>">
                <input type="hidden" name="check_out" value="<?php echo $check_out; ?>">
                <input type="hidden" name="guests" value="<?php echo $guests; ?>">
                
                <h3 style="color:#00ff88; border-bottom:1px solid #333; padding-bottom:10px; margin-bottom:20px;">Guest Information</h3>

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" required class="form-input" placeholder="Enter your full name">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" required class="form-input" placeholder="name@example.com">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" required class="form-input" placeholder="+1 234 567 890">
                    </div>
                </div>

                <div class="form-group">
                    <label style="color:#00ff88; font-weight:bold;"><i class="fab fa-whatsapp"></i> WhatsApp Number (Required)</label>
                    <input type="text" name="whatsapp" required class="form-input" placeholder="For booking confirmation...">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>NIC / Passport</label>
                        <input type="text" name="nic" required class="form-input">
                    </div>
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" name="country" required class="form-input">
                    </div>
                </div>

                <div class="form-group">
                    <label>Street Address</label>
                    <input type="text" name="address" required class="form-input">
                </div>

                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" required class="form-input">
                </div>

                <h3 style="color:#00ff88; border-bottom:1px solid #333; padding-bottom:10px; margin: 30px 0 20px;">Payment Details</h3>

                <div class="form-group">
                    <label>Select Payment Method</label>
                    <select name="payment" class="form-input" style="height: 50px;">
                        <option value="cash">Pay at Hotel (Cash/Card)</option>
                        <option value="bank">Direct Bank Transfer</option>
                    </select>
                </div>

                <button type="submit" name="confirm" class="btn-submit" style="margin-top: 20px; width: 100%; font-size: 1.1rem;">
                    Confirm & Book Now <i class="fas fa-arrow-right"></i>
                </button>
            </form>
        </div>
        
        <!-- RIGHT: Summary (Sticky) -->
        <aside>
            <div style="background:#1a1a1a; padding:25px; border-radius:15px; border:1px solid #333; position:sticky; top:100px;">
                <h3 style="color:#fff; text-align:center; margin-bottom:20px;">Booking Summary</h3>
                
                <img src="<?php echo $room['image_url']; ?>" style="width:100%; height:180px; object-fit:cover; border-radius:10px; margin-bottom:15px;">
                
                <h4 style="color:#00ff88; font-size:1.3rem; margin-bottom:5px;"><?php echo $room['room_type']; ?></h4>
                <p style="color:#888; font-size:0.9rem;">Room #<?php echo $room['room_number']; ?></p>
                
                <div style="margin-top:20px; border-top:1px solid #333; padding-top:15px;">
                    <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
                        <span style="color:#bbb;">Check-in</span>
                        <span style="color:#fff;"><?php echo $check_in; ?></span>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
                        <span style="color:#bbb;">Check-out</span>
                        <span style="color:#fff;"><?php echo $check_out; ?></span>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
                        <span style="color:#bbb;">Guests</span>
                        <span style="color:#fff;"><?php echo $guests; ?></span>
                    </div>
                </div>

                <div style="border-top:1px solid #333; padding-top:15px; margin-top:10px; display:flex; justify-content:space-between; align-items:center;">
                    <span style="color:#fff; font-size:1.1rem;">Total Amount</span>
                    <?php 
                        $days = (new DateTime($check_in))->diff(new DateTime($check_out))->days;
                        $total = $room['price'] * $days;
                    ?>
                    <span style="color:#00ff88; font-size:1.8rem; font-weight:bold;">$<?php echo number_format($total, 0); ?></span>
                </div>
            </div>
        </aside>

    </div>
</div>

<style>
    /* Inline styles to guarantee fix regardless of external CSS */
    .form-input {
        width: 100%;
        padding: 12px;
        background: #0a0a0a;
        border: 1px solid #333;
        color: #fff;
        border-radius: 8px;
        font-size: 1rem;
        outline: none;
        transition: 0.3s;
    }
    .form-input:focus {
        border-color: #00ff88;
    }
    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }
    @media (max-width: 768px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<?php include 'includes/footer.php'; ?>