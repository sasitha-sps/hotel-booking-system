<?php 
include 'config.php'; 
include 'includes/header.php'; 
?>

<!-- Hero Section with Video Background -->
<section class="hero-video">
    <div class="video-container">
        <!-- Video with fallback image -->
        <video class="background-video" autoplay muted loop playsinline poster="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80">
            <source src="https://cdn.pixabay.com/video/2023/02/28/160456-801840301_large.mp4" type="video/mp4">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="Luxury Hotel" class="fallback-image">
        </video>
        
        <!-- Static background fallback -->
        <div class="static-background" style="background-image: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80')"></div>
        
        <div class="video-overlay"></div>
    </div>
    
    <div class="container">
        <div class="hero-content-centered">
            <div class="hero-badge">
                <span>LUXURY REDEFINED</span>
            </div>
            <h1 class="hero-title-main">ELEVATE YOUR STAY</h1>
            <p class="hero-subtitle-main">Where timeless elegance meets modern sophistication in the heart of the city</p>
            <div class="hero-cta">
                <a href="#booking-form" class="btn-hero-primary">
                    <span>Book Your Suite</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
                <a href="#suites" class="btn-hero-secondary">
                    <i class="fas fa-play"></i>
                    <span>Explore Experience</span>
                </a>
            </div>
        </div>
    </div>
    
    <div class="scroll-indicator">
        <div class="scroll-arrow"></div>
    </div>
</section>

<!-- Quick Booking Bar (Fixed & Uncommented) -->
<section class="quick-booking" id="booking-form">
    <div class="container">
        <div class="booking-bar">
            <form action="booking.php" method="GET" class="booking-form-compact">
                <div class="form-group-compact">
                    <label>Check-in</label>
                    <input type="date" name="check_in" id="check_in" required min="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group-compact">
                    <label>Check-out</label>
                    <input type="date" name="check_out" id="check_out" required min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                </div>
                <div class="form-group-compact">
                    <label>Guests</label>
                    <select name="guests">
                        <option value="1">1 Guest</option>
                        <option value="2" selected>2 Guests</option>
                        <option value="3">3 Guests</option>
                        <option value="4">4 Guests</option>
                    </select>
                </div>
                <button type="submit" class="btn-check-availability">
                    Check Availability
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Luxury Suites Section -->
<section class="luxury-suites" id="suites">
    <div class="container">
        <div class="section-header-minimal">
            <span class="section-label">ACCOMMODATION</span>
            <h2>Luxury Suites & Rooms</h2>
            <p>Indulge in our carefully curated collection of suites, each designed to offer unparalleled comfort and style</p>
        </div>
        
        <div class="suites-showcase">
            <div class="suite-card featured">
                <div class="suite-image">
                    <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Presidential Suite">
                    <div class="suite-overlay">
                        <div class="suite-price">
                            <span class="amount">$499</span>
                            <span class="period">/ night</span>
                        </div>
                        <a href="booking.php" class="btn-suite-view">View Availability</a>
                    </div>
                </div>
                <div class="suite-info">
                    <h3>Presidential Suite</h3>
                    <p>Ultimate luxury with panoramic city views and exclusive amenities</p>
                    <div class="suite-features">
                        <span><i class="fas fa-ruler-combined"></i> 120m²</span>
                        <span><i class="fas fa-user"></i> 4 Guests</span>
                        <span><i class="fas fa-bed"></i> King Bed</span>
                    </div>
                </div>
            </div>

            <div class="suites-grid">
                <div class="suite-card">
                    <div class="suite-image">
                        <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Executive Suite">
                        <div class="suite-overlay">
                            <div class="suite-price">
                                <span class="amount">$299</span>
                                <span class="period">/ night</span>
                            </div>
                            <a href="booking.php" class="btn-suite-view">View Availability</a>
                        </div>
                    </div>
                    <div class="suite-info">
                        <h3>Executive Suite</h3>
                        <p>Spacious living area with dedicated workspace</p>
                        <div class="suite-features">
                            <span><i class="fas fa-ruler-combined"></i> 65m²</span>
                            <span><i class="fas fa-user"></i> 3 Guests</span>
                        </div>
                    </div>
                </div>

                <div class="suite-card">
                    <div class="suite-image">
                        <img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Deluxe Room">
                        <div class="suite-overlay">
                            <div class="suite-price">
                                <span class="amount">$199</span>
                                <span class="period">/ night</span>
                            </div>
                            <a href="booking.php" class="btn-suite-view">View Availability</a>
                        </div>
                    </div>
                    <div class="suite-info">
                        <h3>Deluxe Room</h3>
                        <p>Modern comfort with premium amenities</p>
                        <div class="suite-features">
                            <span><i class="fas fa-ruler-combined"></i> 45m²</span>
                            <span><i class="fas fa-user"></i> 2 Guests</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Experience Section -->
<section class="hotel-experience" id="experience">
    <div class="container">
        <div class="experience-grid">
            <div class="experience-content">
                <div class="section-header-minimal">
                    <span class="section-label">EXPERIENCE</span>
                    <h2>Unforgettable Moments</h2>
                    <p>Discover a world of luxury and comfort where every detail is crafted to perfection</p>
                </div>
                
                <div class="experience-features">
                    <div class="experience-item">
                        <div class="experience-icon"><i class="fas fa-spa"></i></div>
                        <div class="experience-text">
                            <h4>Luxury Spa</h4>
                            <p>Rejuvenate your senses with our premium spa treatments and therapies</p>
                        </div>
                    </div>
                    <div class="experience-item">
                        <div class="experience-icon"><i class="fas fa-infinity"></i></div>
                        <div class="experience-text">
                            <h4>Infinity Pool</h4>
                            <p>Swim with breathtaking city views in our temperature-controlled infinity pool</p>
                        </div>
                    </div>
                    <div class="experience-item">
                        <div class="experience-icon"><i class="fas fa-dumbbell"></i></div>
                        <div class="experience-text">
                            <h4>Fitness Center</h4>
                            <p>State-of-the-art equipment with personal training sessions available</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="experience-visual">
                <div class="visual-card">
                    <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Hotel Experience">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">50+</div>
                <div class="stat-label">Luxury Suites</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">4.9</div>
                <div class="stat-label">Guest Rating</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Concierge</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">5*</div>
                <div class="stat-label">Hotel Rating</div>
            </div>
        </div>
    </div>
</section>

<!-- Dining Section -->
<section class="dining-section" id="dining">
    <div class="container">
        <div class="section-header-minimal">
            <span class="section-label">DINING</span>
            <h2>Culinary Excellence</h2>
            <p>Experience world-class dining with our award-winning restaurants and bars</p>
        </div>
        
        <div class="dining-grid">
            <div class="restaurant-card">
                <div class="restaurant-image">
                    <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Signature Restaurant">
                </div>
                <div class="restaurant-info">
                    <h3>Signature Restaurant</h3>
                    <p>Michelin-star dining with panoramic city views</p>
                    <div class="restaurant-details">
                        <span><i class="fas fa-clock"></i> 6:00 PM - 11:00 PM</span>
                        <span><i class="fas fa-utensils"></i> International Cuisine</span>
                    </div>
                </div>
            </div>
            
            <div class="restaurant-card">
                <div class="restaurant-image">
                    <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Sky Bar">
                </div>
                <div class="restaurant-info">
                    <h3>Sky Bar</h3>
                    <p>Rooftop cocktails with stunning sunset views</p>
                    <div class="restaurant-details">
                        <span><i class="fas fa-clock"></i> 4:00 PM - 2:00 AM</span>
                        <span><i class="fas fa-cocktail"></i> Craft Cocktails</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="gallery-section" id="gallery">
    <div class="container">
        <div class="section-header-minimal">
            <span class="section-label">GALLERY</span>
            <h2>Visual Journey</h2>
            <p>Explore the beauty and elegance of LuxStay through our visual collection</p>
        </div>
        
        <div class="gallery-masonry">
            <div class="gallery-column">
                <div class="gallery-item tall">
                    <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Hotel Lobby">
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Swimming Pool">
                </div>
            </div>
            <div class="gallery-column">
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Bedroom">
                </div>
                <div class="gallery-item tall">
                    <img src="https://images.unsplash.com/photo-1584132967334-10e028bd69f7?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Bathroom">
                </div>
            </div>
            <div class="gallery-column">
                <div class="gallery-item tall">
                    <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Hotel Exterior">
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Spa">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section" id="contact">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-info">
                <div class="section-header-minimal">
                    <span class="section-label">CONTACT</span>
                    <h2>Get In Touch</h2>
                    <p>Ready to experience luxury? Contact us for reservations and inquiries</p>
                </div>
                
                <div class="contact-details">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h4>Visit Us</h4>
                            <p>123 Luxury Avenue<br>Premium District, City 12345</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h4>Call Us</h4>
                            <p>+1 (555) 123-4567</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h4>Email Us</h4>
                            <p>info@luxstay.com</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="contact-form-wrapper">
                <form class="contact-form-elegant">
                    <h3>Send us a Message</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" placeholder="Your Email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Subject" required>
                    </div>
                    <div class="form-group">
                        <textarea placeholder="Your Message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">
                        <span>Send Message</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

<!-- Combined Scripts -->
<script>
    // 1. Mobile Menu Toggle (Matches header.php IDs)
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            this.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            document.body.classList.toggle('menu-open');
        });

        // Close menu when clicking links
        document.querySelectorAll('.mobile-nav-link').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenuBtn.classList.remove('active');
                mobileMenu.classList.remove('active');
                document.body.classList.remove('menu-open');
            });
        });
    }

    // 2. Date Logic for Booking Form
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');

    if (checkInInput && checkOutInput) {
        checkInInput.addEventListener('change', function() {
            const checkInDate = new Date(this.value);
            // Minimum check-out is 1 day after check-in
            checkInDate.setDate(checkInDate.getDate() + 1);
            
            const nextDay = checkInDate.toISOString().split('T')[0];
            checkOutInput.min = nextDay;
            
            // If current checkout is invalid, clear it or set to min
            if (checkOutInput.value && checkOutInput.value < nextDay) {
                checkOutInput.value = nextDay;
            }
        });
    }

    // 3. Smooth Scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // 4. Video Error Handling
    const video = document.querySelector('.background-video');
    if (video) {
        video.addEventListener('error', () => {
            document.querySelector('.video-container').classList.add('video-fallback');
        });
    }
</script>