<?php
session_start();
include 'config.php';

// Check if a booking reference exists in the session
if (!isset($_SESSION['ref'])) { 
    // If accessed directly without a booking, go back home
    header('Location: index.php'); 
    exit(); 
}

$ref = $_SESSION['ref'];

// Optional: Fetch booking details to show the name
$stmt = $pdo->prepare("SELECT * FROM bookings WHERE booking_ref = ?");
$stmt->execute([$ref]);
$booking = $stmt->fetch(PDO::FETCH_ASSOC);

// Clear the session ref so refreshing doesn't cause issues
// unset($_SESSION['ref']); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed - LuxStay</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Print-specific styles for a simple receipt */
        @media print {
            /* Hide global site elements */
            .header, header, .footer, footer, body > .header, body > .footer {
                display: none !important;
            }
            
            /* Reset body styling */
            body {
                background-color: #fff !important;
                color: #000 !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            /* Container reset */
            .container {
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
            }

            /* Card styling as a receipt */
            .confirmation-card {
                background: #fff !important;
                color: #000 !important;
                border: 2px solid #000 !important; /* Receipt border */
                border-radius: 0 !important;
                box-shadow: none !important;
                width: 100% !important;
                max-width: 400px !important; /* Limit width like a receipt */
                margin: 20px auto !important; /* Center it */
                padding: 20px !important;
                text-align: center !important;
            }

            /* Hide decorative icons and buttons */
            .success-icon, .btn-book, .button-group, a {
                display: none !important;
            }

            /* Ensure text is black and readable */
            .confirmation-card h1, 
            .confirmation-card h2, 
            .confirmation-card p, 
            .confirmation-card strong, 
            .confirmation-card small {
                color: #000 !important;
            }

            /* Override inner dark boxes */
            .confirmation-card div[style*="background:#222"] {
                background: transparent !important;
                border: none !important;
                padding: 0 !important;
                margin: 10px 0 !important;
                text-align: left !important;
            }

            /* Add Receipt Header */
            .confirmation-card::before {
                content: "LUXSTAY HOTEL - RECEIPT";
                display: block;
                font-weight: bold;
                font-size: 18px;
                border-bottom: 2px dashed #000;
                padding-bottom: 10px;
                margin-bottom: 20px;
            }

            /* Format Reference Number */
            .confirmation-card h2 {
                border: 1px solid #000;
                padding: 5px;
                margin: 10px 0 !important;
                display: inline-block;
            }
        }
    </style>
</head>
<body style="background:#0a0a0a; color:#fff;">

    <?php include 'includes/header.php'; ?>

    <div class="container" style="padding-top: 150px; padding-bottom: 100px;">
        <div class="confirmation-card" style="text-align:center; padding:50px; background:#1a1a1a; border-radius:15px; border:1px solid #00ff88; max-width:700px; margin:0 auto;">
            
            <div class="success-icon">
                <i class="fas fa-check-circle" style="font-size:5rem; color:#00ff88; margin-bottom:20px;"></i>
            </div>
            
            <h1 style="color:#fff; margin-bottom: 10px;">Request Received!</h1>
            
            <?php if ($booking): ?>
                <p style="color:#bbb; font-size: 1.1rem;">Thank you, <strong><?php echo htmlspecialchars($booking['guest_name']); ?></strong>.</p>
            <?php endif; ?>

            <div style="background:#222; padding:20px; border-radius:10px; margin:30px 0; text-align:left;">
                <p style="color:#bbb; margin-bottom: 10px;">Reference Number:</p>
                <h2 style="color:#00ff88; letter-spacing: 2px; margin: 0;"><?php echo $ref; ?></h2>
                <hr style="border:0; border-top:1px solid #444; margin:15px 0;">
                <p style="color:#fff;"><i class="fas fa-info-circle"></i> <strong>Status: Pending Approval</strong></p>
                <p style="color:#999; font-size:0.9rem; margin-top: 5px;">
                    Your booking is currently pending. Our team will review the details and contact you via <strong>WhatsApp</strong> shortly to finalize the payment.
                </p>
            </div>

            <div class="button-group" style="display: flex; gap: 10px; justify-content: center;">
                <a href="index.php" class="btn-book" style="background: transparent; border: 1px solid #00ff88; color: #00ff88;">Return Home</a>
                <button onclick="window.print()" class="btn-book">Print Receipt</button>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

</body>
</html>