@extends('layouts/blankLayout')

@section('title', 'Login Basic - Pages')

@section('page-style')
@vite([
  'resources/assets/vendor/scss/pages/page-auth.scss'
])
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
            <div class="mb-6">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="********" required />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>

            <div class="mb-6">
              <button type="submit" class="btn btn-primary d-grid w-100">Login</button>
            </div>

            <div id="loginMessage" class="text-center"></div>
          </form>

          <p class="text-center">
            <a href="{{url('/register')}}">
              <span>Register an account</span>
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");

    loginForm.addEventListener("submit", async function (event) {
        event.preventDefault(); // Mencegah reload halaman

        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;
        const loginMessage = document.getElementById("loginMessage");

        loginMessage.innerHTML = "Logging in..."; // Menampilkan pesan loading

        try {
            const response = await fetch("http://127.0.0.1:8001/api/login", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify({ username, password })
            });

            const data = await response.json();

            if (response.ok) {
                loginMessage.innerHTML = '<span style="color: green;">Login Berhasil!</span>';
                localStorage.setItem("token", data.token); // Simpan token
                window.location.href = "/"; // Redirect ke dashboard
            } else {
                loginMessage.innerHTML = '<span style="color: red;">' + data.message + '</span>';
            }
        } catch (error) {
            loginMessage.innerHTML = '<span style="color: red;">Server Error</span>';
        }
    });
});
</script>

@endsection
