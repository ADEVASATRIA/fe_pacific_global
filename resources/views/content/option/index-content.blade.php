@extends('layouts/blankLayout')
@section('title', 'Options')

@section('page-style')
@vite([
  'resources/assets/css/option/option.css',
])
@endsection

@section('content')
<div class="background-shapes">
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
</div>

<div class="container">
    <h1>Selamat Datang di Portal Office</h1>
    <p class="subtitle">Silakan pilih tujuan Anda untuk melanjutkan</p>
    
    <div class="buttons">
        <a href="/dashboard" class="button back-office">
            <i class="fas fa-user-shield icon"></i>
            <span>Back Office</span>
        </a>
        
        <a href="/home-front" class="button front-office">
            <i class="fas fa-user-tie icon"></i>
            <span>Front Office</span>
        </a>
    </div>
</div>

<footer>
    &copy; 2025 Portal Office System. All rights reserved.
</footer>
@endsection