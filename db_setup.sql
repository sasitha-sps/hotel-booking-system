DROP TABLE IF EXISTS bookings;
DROP TABLE IF EXISTS rooms;
DROP TABLE IF EXISTS admin_users;

-- 1. Admin Table
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Password is: admin123
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admin_users (username, password) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- 2. Rooms Table
CREATE TABLE rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_number VARCHAR(10) NOT NULL,
    room_type VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    status ENUM('available', 'booked', 'cleaning', 'maintenance') DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO rooms (room_number, room_type, price, description, image_url, status) VALUES 
('101', 'Luxury Suite', 150.00, 'King bed, city view', 'https://images.unsplash.com/photo-1611892440504-42a792e24d32', 'available'),
('102', 'Luxury Suite', 150.00, 'King bed, city view', 'https://images.unsplash.com/photo-1611892440504-42a792e24d32', 'available'),
('103', 'Deluxe Room', 100.00, 'Queen bed, cozy setup', 'https://images.unsplash.com/photo-1566665797739-1674de7a421a', 'available'),
('104', 'Deluxe Room', 100.00, 'Queen bed, balcony', 'https://images.unsplash.com/photo-1566665797739-1674de7a421a', 'available'),
('105', 'Standard Room', 80.00, 'Double bed, modern amenities', 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7', 'available');

-- 3. Bookings Table
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_ref VARCHAR(20) NOT NULL UNIQUE,
    room_id INT NOT NULL,
    check_in DATE NOT NULL,
    check_out DATE NOT NULL,
    guests INT DEFAULT 1,
    total_amount DECIMAL(10, 2) NOT NULL,
    guest_name VARCHAR(100) NOT NULL,
    guest_email VARCHAR(100) NOT NULL,
    guest_phone VARCHAR(20) NOT NULL,
    guest_whatsapp VARCHAR(20),
    guest_nic VARCHAR(20) NOT NULL,
    guest_address TEXT,
    guest_city VARCHAR(50),
    guest_country VARCHAR(50),
    special_requests TEXT,
    payment_method VARCHAR(20),
    payment_status ENUM('pending', 'paid') DEFAULT 'pending',
    status ENUM('pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (room_id) REFERENCES rooms(id)
);