    </main>

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-main">
                <div class="footer-brand">
                    <div class="footer-logo">LUXSTAY</div>
                    <p class="footer-description">Experience unparalleled luxury and comfort in the heart of the city. Your perfect getaway awaits at LuxStay Hotel.</p>
                    
                    <div class="footer-newsletter">
                        <h4>Stay Updated</h4>
                        <form class="newsletter-form">
                            <input type="email" placeholder="Enter your email" required>
                            <button type="submit">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="index.php#suites"><i class="fas fa-bed"></i> Suites & Rooms</a></li>
                        <li><a href="index.php#experience"><i class="fas fa-star"></i> Experience</a></li>
                        <li><a href="index.php#dining"><i class="fas fa-utensils"></i> Dining</a></li>
                        <li><a href="index.php#gallery"><i class="fas fa-images"></i> Gallery</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h4>Services</h4>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-spa"></i> Spa & Wellness</a></li>
                        <li><a href="#"><i class="fas fa-infinity"></i> Infinity Pool</a></li>
                        <li><a href="#"><i class="fas fa-dumbbell"></i> Fitness Center</a></li>
                        <li><a href="#"><i class="fas fa-business-time"></i> Business Center</a></li>
                        <li><a href="#"><i class="fas fa-concierge-bell"></i> Concierge</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h4>Contact Info</h4>
                    <div class="footer-contact">
                        <div class="contact-info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <strong>Address</strong>
                                <p>123 Luxury Avenue<br>Premium District, City 12345</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <strong>Phone</strong>
                                <p>+1 (555) 123-4567</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <strong>Email</strong>
                                <p>info@luxstay.com</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="footer-social">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="footer-copyright">
                    <p>&copy; <?php echo date('Y'); ?> LuxStay Hotel. All rights reserved. | Luxury Redefined</p>
                </div>
                <div class="footer-legal">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Back to Top Button
        const backToTop = document.getElementById('backToTop');

        backToTop.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });

        // Newsletter form submission
        document.querySelector('.newsletter-form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const input = this.querySelector('input[type="email"]');
            alert('Thank you for subscribing to our newsletter!');
            input.value = '';
        });

        // Add loading animation to page
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('loaded');
        });
    </script>
</body>
</html>