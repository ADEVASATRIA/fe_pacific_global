@extends('layouts/blankLayout')
@section('title', 'Pesan Tiket | Pacific Global')

@section('page-style')
    @vite(['resources/assets/css/front/ticket/ticket.css'])
@endsection

@section('page-script')
    @vite(['resources/js/service/front/ticket/ticket.js'])
@endsection

@section('content')

<body class="font-sans antialiased text-gray-800">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-2xl font-bold text-blue-700">Pacific Global</span>
            </div>
            <nav class="space-x-6 hidden md:block">
                <div class="relative group inline-block">
                    <button class="text-gray-700 hover:text-blue-600 flex items-center">
                        Tiket
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md mt-2 w-48 z-10">
                        <a href="{{ route('ticketView') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-50">Domestik</a>
                        <a href="{{ route('ticketView') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-50">Foreigner</a>
                    </div>
                </div>
                <a href="#" class="text-gray-700 hover:text-blue-600">Promo</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">Event</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">Atraksi</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">Kuliner</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">Blog</a>
            </nav>
            <div class="md:hidden">
                <button class="text-gray-600">
                    <!-- Mobile menu icon -->
                    ☰
                </button>
            </div>
        </div>
    </header>

    <!-- Ticket Booking Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-center text-blue-800 mb-8">Pesan Tiket Masuk</h1>
            
            <!-- Ticket Type Tabs -->
            <div class="flex justify-center mb-8">
                <div class="inline-flex rounded-md shadow-sm">
                    <a href="{{ route('ticketView') }}" class="px-6 py-3 text-sm font-medium rounded-l-lg 
                        {{ request()->is('tickets/domestic') ? 'bg-blue-600 text-white' : 'bg-white text-blue-600 hover:bg-gray-50' }}">
                        Tiket Domestik
                    </a>
                    <a href="{{ route('ticketView') }}" class="px-6 py-3 text-sm font-medium rounded-r-lg 
                        {{ request()->is('tickets/foreigner') ? 'bg-blue-600 text-white' : 'bg-white text-blue-600 hover:bg-gray-50' }}">
                        Tiket Foreigner
                    </a>
                </div>
            </div>

            @if(request()->is('tickets/domestic'))
                <!-- Domestic Ticket Form -->
                <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tiket Domestik - WNI</h2>
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Ticket Selection -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Pilih Jenis Tiket</h3>
                            
                            <div class="space-y-4">
                                <div class="border rounded-lg p-4 hover:border-blue-500 transition">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium">Tiket Harian Weekday</h4>
                                            <p class="text-sm text-gray-500">Senin-Jumat (Tidak termasuk hari libur nasional)</p>
                                        </div>
                                        <span class="font-bold text-blue-600">Rp 150.000</span>
                                    </div>
                                    <div class="mt-3 flex items-center">
                                        <button class="bg-gray-200 px-2 py-1 rounded">-</button>
                                        <input type="number" class="w-12 text-center mx-2 border rounded" value="0" min="0">
                                        <button class="bg-gray-200 px-2 py-1 rounded">+</button>
                                    </div>
                                </div>
                                
                                <div class="border rounded-lg p-4 hover:border-blue-500 transition">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium">Tiket Harian Weekend</h4>
                                            <p class="text-sm text-gray-500">Sabtu, Minggu & Hari Libur Nasional</p>
                                        </div>
                                        <span class="font-bold text-blue-600">Rp 250.000</span>
                                    </div>
                                    <div class="mt-3 flex items-center">
                                        <button class="bg-gray-200 px-2 py-1 rounded">-</button>
                                        <input type="number" class="w-12 text-center mx-2 border rounded" value="0" min="0">
                                        <button class="bg-gray-200 px-2 py-1 rounded">+</button>
                                    </div>
                                </div>
                                
                                <div class="border rounded-lg p-4 hover:border-blue-500 transition">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium">Tiket Anak (3-12 tahun)</h4>
                                            <p class="text-sm text-gray-500">Weekday & Weekend</p>
                                        </div>
                                        <span class="font-bold text-blue-600">Rp 100.000</span>
                                    </div>
                                    <div class="mt-3 flex items-center">
                                        <button class="bg-gray-200 px-2 py-1 rounded">-</button>
                                        <input type="number" class="w-12 text-center mx-2 border rounded" value="0" min="0">
                                        <button class="bg-gray-200 px-2 py-1 rounded">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Date Selection & Summary -->
                        <div>
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Pilih Tanggal Kunjungan</h3>
                                <input type="date" class="w-full p-2 border rounded-md" min="{{ date('Y-m-d') }}">
                            </div>
                            
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-900 mb-3">Ringkasan Pembelian</h3>
                                
                                <div class="space-y-2 mb-4">
                                    <div class="flex justify-between">
                                        <span>Tiket Harian Weekday x0</span>
                                        <span>Rp 0</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Tiket Harian Weekend x0</span>
                                        <span>Rp 0</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Tiket Anak x0</span>
                                        <span>Rp 0</span>
                                    </div>
                                </div>
                                
                                <div class="border-t pt-3">
                                    <div class="flex justify-between font-bold">
                                        <span>Total Pembayaran</span>
                                        <span>Rp 0</span>
                                    </div>
                                </div>
                                
                                <button class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition">
                                    Lanjutkan Pembayaran
                                </button>
                                
                                <p class="text-xs text-gray-500 mt-2">
                                    *Harga sudah termasuk pajak dan biaya layanan
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Foreigner Ticket Form -->
                <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tiket Foreigner - WNA</h2>
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Ticket Selection -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Pilih Jenis Tiket</h3>
                            
                            <div class="space-y-4">
                                <div class="border rounded-lg p-4 hover:border-blue-500 transition">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium">Regular Ticket (Weekday)</h4>
                                            <p class="text-sm text-gray-500">Monday-Friday (Excluding national holidays)</p>
                                        </div>
                                        <span class="font-bold text-blue-600">Rp 300.000</span>
                                    </div>
                                    <div class="mt-3 flex items-center">
                                        <button class="bg-gray-200 px-2 py-1 rounded">-</button>
                                        <input type="number" class="w-12 text-center mx-2 border rounded" value="0" min="0">
                                        <button class="bg-gray-200 px-2 py-1 rounded">+</button>
                                    </div>
                                </div>
                                
                                <div class="border rounded-lg p-4 hover:border-blue-500 transition">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium">Regular Ticket (Weekend)</h4>
                                            <p class="text-sm text-gray-500">Saturday, Sunday & National Holidays</p>
                                        </div>
                                        <span class="font-bold text-blue-600">Rp 400.000</span>
                                    </div>
                                    <div class="mt-3 flex items-center">
                                        <button class="bg-gray-200 px-2 py-1 rounded">-</button>
                                        <input type="number" class="w-12 text-center mx-2 border rounded" value="0" min="0">
                                        <button class="bg-gray-200 px-2 py-1 rounded">+</button>
                                    </div>
                                </div>
                                
                                <div class="border rounded-lg p-4 hover:border-blue-500 transition">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium">Child Ticket (3-12 years)</h4>
                                            <p class="text-sm text-gray-500">Weekday & Weekend</p>
                                        </div>
                                        <span class="font-bold text-blue-600">Rp 200.000</span>
                                    </div>
                                    <div class="mt-3 flex items-center">
                                        <button class="bg-gray-200 px-2 py-1 rounded">-</button>
                                        <input type="number" class="w-12 text-center mx-2 border rounded" value="0" min="0">
                                        <button class="bg-gray-200 px-2 py-1 rounded">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Date Selection & Summary -->
                        <div>
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Visit Date</h3>
                                <input type="date" class="w-full p-2 border rounded-md" min="{{ date('Y-m-d') }}">
                            </div>
                            
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-900 mb-3">Order Summary</h3>
                                
                                <div class="space-y-2 mb-4">
                                    <div class="flex justify-between">
                                        <span>Regular Weekday x0</span>
                                        <span>Rp 0</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Regular Weekend x0</span>
                                        <span>Rp 0</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Child Ticket x0</span>
                                        <span>Rp 0</span>
                                    </div>
                                </div>
                                
                                <div class="border-t pt-3">
                                    <div class="flex justify-between font-bold">
                                        <span>Total Payment</span>
                                        <span>Rp 0</span>
                                    </div>
                                </div>
                                
                                <button class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition">
                                    Continue to Payment
                                </button>
                                
                                <p class="text-xs text-gray-500 mt-2">
                                    *Prices include tax and service charges
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p class="mb-4">&copy; 2025 Pacific Global. All Rights Reserved.</p>
            <div class="flex justify-center space-x-4 text-sm">
                <a href="#" class="hover:underline">Privacy Policy</a>
                <a href="#" class="hover:underline">Terms & Conditions</a>
                <a href="#" class="hover:underline">Contact Us</a>
            </div>
        </div>
    </footer>
</body>
@endsection