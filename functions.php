<?php
// Prevent re-declaration errors
if (!function_exists('sanitize_input')) {
    function sanitize_input($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }
}

if (!function_exists('get_available_rooms')) {
    function get_available_rooms($check_in, $check_out, $pdo) {
        // SQL: Find rooms that are 'available' AND NOT booked during the selected dates
        // We check the 'bookings' table column 'status' (not booking_status)
        $sql = "SELECT r.* FROM rooms r 
                WHERE r.status = 'available' 
                AND r.id NOT IN (
                    SELECT room_id FROM bookings 
                    WHERE status IN ('confirmed', 'checked_in', 'pending')
                    AND (
                        (check_in <= ? AND check_out >= ?) OR
                        (check_in >= ? AND check_in < ?) OR
                        (check_out > ? AND check_out <= ?)
                    )
                )";
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$check_out, $check_in, $check_in, $check_out, $check_in, $check_out]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error or return empty array to prevent crash
            return [];
        }
    }
}
?>