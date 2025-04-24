@extends('layouts/blankLayout')
@section('title', 'Home | Dashboard Front Office')

@section('page-style')
    @vite(['resources/assets/css/front/home/home.css'])
@endsection

@section('page-script')
    @vite(['resources/js/service/front/home/home.js'])
@endsection


@section('content')
<nav class="navbar">
    <a href="#" class="logo">
        <i class="fas fa-ticket-alt"></i>
        <span>BookingSystem</span>
    </a>
    <div class="nav-links">
        <a href="#" class="active">Home</a>
        <a href="#">Destinasi</a>
        <a href="#">Promo</a>
        <a href="#">Bantuan</a>
        <a href="#">Kontak</a>
    </div>
    <button class="hamburger">
        <i class="fas fa-bars"></i>
    </button>
</nav>

<div class="hero">
    <h1>Temukan Pengalaman Perjalanan Terbaik</h1>
    <p>Jelajahi dunia dengan kemudahan booking dan harga terbaik untuk destinasi impian Anda</p>
</div>

<div class="container">
    <div class="search-card">
        <form class="search-form">
            <div class="form-group">
                <label for="destination">Tujuan</label>
                <input type="text" id="destination" class="form-control" placeholder="Kemana Anda ingin pergi?">
            </div>
            <div class="form-group">
                <label for="departure-date">Tanggal Berangkat</label>
                <input type="date" id="departure-date" class="form-control">
            </div>
            <div class="form-group">
                <label for="return-date">Tanggal Kembali</label>
                <input type="date" id="return-date" class="form-control">
            </div>
            <div class="form-group">
                <label for="guests">Jumlah Tamu</label>
                <select id="guests" class="form-control">
                    <option value="1">1 Orang</option>
                    <option value="2">2 Orang</option>
                    <option value="3">3 Orang</option>
                    <option value="4">4 Orang</option>
                    <option value="5">5+ Orang</option>
                </select>
            </div>
            <div class="search-btn">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-search"></i>
                    <span>Cari Tiket</span>
                </button>
            </div>
        </form>
    </div>

    <div class="popular-section">
        <h2 class="section-title">Destinasi Populer</h2>
        <div class="card-grid">
            <div class="card">
                <div class="card-img" style="background: url('/api/placeholder/300/180') center/cover no-repeat;">
                    <span class="card-badge">Terlaris</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Bali - Pantai Kuta</h3>
                    <div class="card-info">
                        <div>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Bali, Indonesia</span>
                        </div>
                        <div>
                            <i class="far fa-clock"></i>
                            <span>3D/2N</span>
                        </div>
                    </div>
                    <div class="card-price">Rp 2.500.000</div>
                    <div class="card-action">
                        <a href="#" class="btn btn-primary">Pesan Sekarang</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-img" style="background: url('/api/placeholder/300/180') center/cover no-repeat;">
                    <span class="card-badge">Diskon 25%</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Yogyakarta - Candi Borobudur</h3>
                    <div class="card-info">
                        <div>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Yogyakarta</span>
                        </div>
                        <div>
                            <i class="far fa-clock"></i>
                            <span>2D/1N</span>
                        </div>
                    </div>
                    <div class="card-price">Rp 1.200.000</div>
                    <div class="card-action">
                        <a href="#" class="btn btn-primary">Pesan Sekarang</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-img" style="background: url('/api/placeholder/300/180') center/cover no-repeat;">
                </div>
                <div class="card-content">
                    <h3 class="card-title">Raja Ampat - Diving Experience</h3>
                    <div class="card-info">
                        <div>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Papua Barat</span>
                        </div>
                        <div>
                            <i class="far fa-clock"></i>
                            <span>5D/4N</span>
                        </div>
                    </div>
                    <div class="card-price">Rp 8.500.000</div>
                    <div class="card-action">
                        <a href="#" class="btn btn-primary">Pesan Sekarang</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-img" style="background: url('/api/placeholder/300/180') center/cover no-repeat;">
                    <span class="card-badge">Baru</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Labuan Bajo - Pulau Komodo</h3>
                    <div class="card-info">
                        <div>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>NTT</span>
                        </div>
                        <div>
                            <i class="far fa-clock"></i>
                            <span>4D/3N</span>
                        </div>
                    </div>
                    <div class="card-price">Rp 5.700.000</div>
                    <div class="card-action">
                        <a href="#" class="btn btn-primary">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="promo-section">
        <div class="promo-content">
            <div class="promo-text">
                <h2 class="promo-title">Dapatkan Diskon Spesial 30%</h2>
                <p class="promo-description">
                    Nikmati penawaran spesial untuk pemesanan tiket ke destinasi pilihan. 
                    Gunakan kode promo HOLIDAY30 dan dapatkan diskon hingga 30% untuk 
                    perjalanan Anda berikutnya.
                </p>
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-tag"></i>
                    <span>Lihat Promo</span>
                </a>
            </div>
            <div class="promo-image">
                <img src="/api/placeholder/400/300" alt="Special Promo" style="max-width: 100%; border-radius: 10px;">
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="footer-content">
        <div class="footer-column">
            <h3>Tentang Kami</h3>
            <ul class="footer-links">
                <li><a href="#">Profil Perusahaan</a></li>
                <li><a href="#">Karir</a></li>
                <li><a href="#">Kebijakan Privasi</a></li>
                <li><a href="#">Syarat & Ketentuan</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Layanan</h3>
            <ul class="footer-links">
                <li><a href="#">Booking Tiket</a></li>
                <li><a href="#">Paket Wisata</a></li>
                <li><a href="#">Corporate Travel</a></li>
                <li><a href="#">Asuransi Perjalanan</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Bantuan</h3>
            <ul class="footer-links">
                <li><a href="#">Pusat Bantuan</a></li>
                <li><a href="#">Cara Pemesanan</a></li>
                <li><a href="#">Pembayaran</a></li>
                <li><a href="#">Pembatalan & Refund</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Hubungi Kami</h3>
            <p>Email: info@bookingsystem.com</p>
            <p>Phone: +62 21 1234 5678</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2025 BookingSystem. All rights reserved.</p>
    </div>
</footer>
@endsection