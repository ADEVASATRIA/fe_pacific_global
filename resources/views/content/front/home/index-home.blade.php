@extends('layouts/blankLayout')
@section('title', 'Home | Dashboard Front Office')

@section('page-style')
    @vite(['resources/assets/css/front/home/home.css'])
@endsection

@section('page-script')
    @vite(['resources/js/service/front/home/home.js'])
@endsection


@section('content')

    <body>
        <!-- Header -->
        <header class="header">
            <div class="logo">PACIFIC GENERAL</div>

            <nav class="nav-links">
                <a href="#" class="nav-link active">Home</a>
                <a href="#" class="nav-link">Tickets</a>
                <a href="#" class="nav-link">Promotions</a>
                <a href="#" class="nav-link">Shop</a>
                <a href="#" class="nav-link">About Us</a>
                <a href="#" class="nav-link">Contact</a>
            </nav>

            <div class="user-menu">
                <div class="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <div class="cart-badge">0</div>
                </div>
                <div class="user-icon">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="hero"
            style="background-image: url('/assets/img/front_assets/hero_2_maldives.jpg'); background-size: cover; background-position: center;">
            <h1 style="color: #fff">Welcome to Pacific Pool</h1>
            <p>Discover the perfect swimming experience for you and your family</p>
        </section>

        <!-- Search Box -->
        <div class="search-container">
            <div class="search-box">
                <div class="search-tabs">
                    <div class="search-tab active">
                        <i class="fas fa-ticket-alt"></i>
                        <span>Tickets</span>
                    </div>
                    <div class="search-tab">
                        <i class="fas fa-swimmer"></i>
                        <span>Activities</span>
                    </div>
                    <div class="search-tab">
                        <i class="fas fa-glass-cheers"></i>
                        <span>Events</span>
                    </div>
                    <div class="search-tab">
                        <i class="fas fa-utensils"></i>
                        <span>Restaurants</span>
                    </div>
                </div>

                <div class="search-options">
                    <div class="search-option">
                        <i class="fas fa-calendar-alt"></i>
                        <div class="search-option-content">
                            <span class="option-label">Visit Type</span>
                            <span class="option-value">Day Pass</span>
                        </div>
                        <i class="fas fa-chevron-down" style="margin-left: auto;"></i>
                    </div>

                    <div class="search-option">
                        <i class="fas fa-users"></i>
                        <div class="search-option-content">
                            <span class="option-label">Visitors</span>
                            <span class="option-value">2 Adults, 1 Child</span>
                        </div>
                        <i class="fas fa-chevron-down" style="margin-left: auto;"></i>
                    </div>

                    <div class="search-option">
                        <i class="fas fa-swimming-pool"></i>
                        <div class="search-option-content">
                            <span class="option-label">Pool Type</span>
                            <span class="option-value">All Pools</span>
                        </div>
                        <i class="fas fa-chevron-down" style="margin-left: auto;"></i>
                    </div>
                </div>

                <form class="search-form">
                    <div class="form-group">
                        <label for="location">Location</label>
                        <div class="input-with-icon">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" id="location" class="form-control" placeholder="Select location"
                                value="Jakarta">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date">Visit Date</label>
                        <div class="input-with-icon">
                            <i class="far fa-calendar"></i>
                            <input type="text" id="date" class="form-control" placeholder="Select date"
                                value="05/10/2025">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="time">Time Slot</label>
                        <div class="input-with-icon">
                            <i class="far fa-clock"></i>
                            <input type="text" id="time" class="form-control" placeholder="Select time"
                                value="09:00 AM">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <div class="input-with-icon">
                            <i class="fas fa-hourglass-half"></i>
                            <input type="text" id="duration" class="form-control" placeholder="Select duration"
                                value="Full Day">
                        </div>
                    </div>

                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                        <span>Search</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Featured Tickets Section -->
            <section class="section">
                <div class="section-header">
                    <h2 class="section-title">Featured Tickets</h2>
                    <a href="#" class="see-all">
                        See All <i class="fas fa-chevron-right"></i>
                    </a>
                </div>

                <div class="cards-grid">
                    <!-- Ticket Card 1 -->
                    <div class="card">
                        <div class="card-image">
                            <img src="/assets/img/front_assets/kolam_renang_pic_1.jpg" alt="Swimming Pool">
                            <div class="card-tag tag-regular">REGULAR</div>
                        </div>
                        <div class="card-content">
                            <br>
                            <h3 class="card-title">TICKET DEWASA</h3>
                            <div class="card-info">
                                <div class="card-info-item">
                                    <i class="fas fa-swimming-pool"></i>
                                    <span>All Pools</span>
                                </div>
                                <div class="card-info-item">
                                    <i class="far fa-clock"></i>
                                    <span>1 Day</span>
                                </div>
                            </div>
                            <div class="card-price">Rp. 40.000,00</div>
                            <div class="card-actions">
                                <div class="card-btn btn-outline">View Details</div>
                                <div class="card-btn btn-primary">Add to Cart</div>
                            </div>
                        </div>
                    </div>

                    <!-- Ticket Card 2 -->
                    <div class="card">
                        <div class="card-image">
                            <img src="/assets/img/front_assets/kolam_renang_pic_1.jpg" alt="Swimming Pool">
                            <div class="card-tag tag-member">MEMBER</div>
                        </div>
                        <div class="card-content">
                            <br>
                            <h3 class="card-title">MEMBER SWIMING CLUB 1 MONTH</h3>
                            <div class="card-info">
                                <div class="card-info-item">
                                    <i class="fas fa-building"></i>
                                    <span>Clubhouse 1</span>
                                </div>
                                <div class="card-info-item">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>30 Days</span>
                                </div>
                            </div>
                            <div class="card-price">Rp. 40.000,00</div>
                            <div class="card-actions">
                                <div class="card-btn btn-outline">View Details</div>
                                <div class="card-btn btn-primary">Add to Cart</div>
                            </div>
                        </div>
                    </div>

                    <!-- Ticket Card 3 -->
                    <div class="card">
                        <div class="card-image">
                            <img src="/assets/img/front_assets/kolam_renang_pic_1.jpg" alt="Swimming Pool">
                            <div class="card-tag tag-package">PACKAGE</div>
                        </div>
                        <div class="card-content">
                            <br>
                            <h3 class="card-title">PACKAGE 2 DEWASA + 1 ANAK-ANAK</h3>
                            <div class="card-info">
                                <div class="card-info-item">
                                    <i class="fas fa-users"></i>
                                    <span>Family</span>
                                </div>
                                <div class="card-info-item">
                                    <i class="far fa-clock"></i>
                                    <span>1 Day</span>
                                </div>
                            </div>
                            <div class="card-price">Rp. 100.000,00</div>
                            <div class="card-actions">
                                <div class="card-btn btn-outline">View Details</div>
                                <div class="card-btn btn-primary">Add to Cart</div>
                            </div>
                        </div>
                    </div>

                    <!-- Ticket Card 4 -->
                    <div class="card">
                        <div class="card-image">
                            <img src="/assets/img/front_assets/kolam_renang_pic_1.jpg" alt="Swimming Pool">
                            <div class="card-tag tag-regular">REGULAR</div>
                        </div>
                        <div class="card-content">
                            <br>
                            <h3 class="card-title">KIDS TICKET</h3>
                            <div class="card-info">
                                <div class="card-info-item">
                                    <i class="fas fa-child"></i>
                                    <span>Kids Pool</span>
                                </div>
                                <div class="card-info-item">
                                    <i class="far fa-clock"></i>
                                    <span>1 Day</span>
                                </div>
                            </div>
                            <div class="card-price">Rp. 30.000,00</div>
                            <div class="card-actions">
                                <div class="card-btn btn-outline">View Details</div>
                                <div class="card-btn btn-primary">Add to Cart</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Special Promotions Section -->
            <section class="section">
                <div class="section-header">
                    <h2 class="section-title">Special Promotions</h2>
                    <a href="#" class="see-all">
                        See All <i class="fas fa-chevron-right"></i>
                    </a>
                </div>

                <div class="cards-grid">
                    <!-- Promo Card 1 -->
                    <div class="card">
                        <div class="card-image">
                            <img src="/assets/img/front_assets/promo_poster_1.png" alt="Weekend Special"
                                style="width: 100%; height: auto; max-height: 165px; object-fit: cover;">
                            <div class="card-tag tag-member">20% OFF</div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">WEEKEND SPECIAL</h3>
                            <div class="card-info">
                                <div class="card-info-item">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>Weekends Only</span>
                                </div>
                                <div class="card-info-item">
                                    <i class="fas fa-users"></i>
                                    <span>Up to 4 People</span>
                                </div>
                            </div>
                            <div class="card-price">Rp. 150.000,00</div>
                            <div class="card-actions">
                                <div class="card-btn btn-outline">View Details</div>
                                <div class="card-btn btn-primary">Add to Cart</div>
                            </div>
                        </div>
                    </div>

                    <!-- Promo Card 2 -->
                    <div class="card">
                        <div class="card-image">
                            <img src="/assets/img/front_assets/promo_poster_1.png" alt="Weekend Special"
                                style="width: 100%; height: auto; max-height: 165px; object-fit: cover;">
                            <div class="card-tag tag-package">BUNDLE</div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">HOLIDAY PACKAGE</h3>
                            <div class="card-info">
                                <div class="card-info-item">
                                    <i class="fas fa-gift"></i>
                                    <span>Incl. Meals</span>
                                </div>
                                <div class="card-info-item">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>2 Days</span>
                                </div>
                            </div>
                            <div class="card-price">Rp. 250.000,00</div>
                            <div class="card-actions">
                                <div class="card-btn btn-outline">View Details</div>
                                <div class="card-btn btn-primary">Add to Cart</div>
                            </div>
                        </div>
                    </div>

                    <!-- Promo Card 3 -->
                    <div class="card">
                        <div class="card-image">
                            <img src="/assets/img/front_assets/promo_poster_1.png" alt="Weekend Special"
                                style="width: 100%; height: auto; max-height: 165px; object-fit: cover;">
                            <div class="card-tag tag-regular">30% OFF</div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">STUDENT DISCOUNT</h3>
                            <div class="card-info">
                                <div class="card-info-item">
                                    <i class="fas fa-graduation-cap"></i>
                                    <span>With Student ID</span>
                                </div>
                                <div class="card-info-item">
                                    <i class="far fa-clock"></i>
                                    <span>1 Day</span>
                                </div>
                            </div>
                            <div class="card-price">Rp. 28.000,00</div>
                            <div class="card-actions">
                                <div class="card-btn btn-outline">View Details</div>
                                <div class="card-btn btn-primary">Add to Cart</div>
                            </div>
                        </div>
                    </div>

                    <!-- Promo Card 4 -->
                    <div class="card">
                        <div class="card-image">
                            <img src="/assets/img/front_assets/promo_poster_1.png" alt="Weekend Special"
                                style="width: 100%; height: auto; max-height: 165px; object-fit: cover;">
                            <div class="card-tag tag-package">GROUP</div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">GROUP BOOKING</h3>
                            <div class="card-info">
                                <div class="card-info-item">
                                    <i class="fas fa-users"></i>
                                    <span>10+ People</span>
                                </div>
                                <div class="card-info-item">
                                    <i class="fas fa-swimming-pool"></i>
                                    <span>Private Pool</span>
                                </div>
                            </div>
                            <div class="card-price">Rp. 500.000,00</div>
                            <div class="card-actions">
                                <div class="card-btn btn-outline">View Details</div>
                                <div class="card-btn btn-primary">Add to Cart</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>About</h3>
                    <div class="footer-links">
                        <a href="#" class="footer-link">Company Info</a>
                        <a href="#" class="footer-link">Our Team</a>
                        <a href="#" class="footer-link">Careers</a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Support</h3>
                    <div class="footer-links">
                        <a href="#" class="footer-link">Help Center</a>
                        <a href="#" class="footer-link">Terms of Service</a>
                        <a href="#" class="footer-link">Privacy Policy</a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Follow Us</h3>
                    <div class="social-links">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                © 2025 Pacific Pool. All rights reserved.
            </div>
        </footer>
    </body>
@endsection
