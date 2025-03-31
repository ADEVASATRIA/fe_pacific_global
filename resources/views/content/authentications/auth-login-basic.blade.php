@extends('layouts/blankLayout')

@section('title', 'Login')

@section('page-style')
@vite([
  'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection

@section('page-script')
    @vite(['resources/js/service/auth/login.js'])
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <div class="card px-sm-6 px-0">
        <div class="card-body">
          <div class="app-brand justify-content-center">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
              <span class="app-brand-text demo text-heading fw-bold">{{config('variables.templateName')}}</span>
            </a>
          </div>

          <form id="loginForm">
            @csrf

            <div class="mb-6">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required autofocus>
            </div>
            
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="********" required />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>

            <div class="mb-6">
              <button type="submit" class="btn btn-primary d-grid w-100" id="loginButton">
                <span id="loginButtonText">Login</span>
                <span id="loginButtonSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
              </button>
            </div>

            <!-- Pesan Error/Sukses -->
            <div id="loginMessage" class="alert d-none"></div>
          </form>

          <p class="text-center mt-3">
            <a href="{{url('/register')}}">
              <span>Register an account</span>
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Toast Notification Container -->
<div id="toastContainer" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11"></div>
@endsection