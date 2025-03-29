@extends('layouts/blankLayout')

@section('title', 'Register Basic - Pages')

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('page-script')
    @vite(['resources/js/service/auth/register.js'])
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <div class="app-brand justify-content-center mb-6">
                            <a href="{{ url('/') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">@include('_partials.macros', [
                                    'width' => 25,
                                    'withbg' => 'var(--bs-primary)',
                                ])</span>
                                <span
                                    class="app-brand-text demo text-heading fw-bold">{{ config('variables.templateName') }}</span>
                            </a>
                        </div>

                        <form id="registerForm" class="mb-6">
                            <!-- Dropdown Role -->
                            <div class="mb-6">
                                <label for="roleSelect" class="form-label">Role</label>
                                <select class="form-select" id="roleSelect" name="role_id">
                                    <option selected>Loading roles...</option>
                                </select>
                            </div>

                            <div class="mb-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Enter your username">
                                <small class="text-danger" id="error-username"></small>
                            </div>
                            <div class="mb-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter your name">
                                <small class="text-danger" id="error-name"></small>
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="********">
                                <small class="text-danger" id="error-password"></small>
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                                <input type="password" id="password_confirmation" class="form-control"
                                    name="password_confirmation" placeholder="********">
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="pin">PIN</label>
                                <input type="password" id="pin" class="form-control" name="pin"
                                    placeholder="******">
                                <small class="text-danger" id="error-pin"></small>
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="pin_confirmation">Confirm PIN</label>
                                <input type="password" id="pin_confirmation" class="form-control" name="pin_confirmation"
                                    placeholder="******">
                            </div>

                            <input type="hidden" id="is_active" name="is_active" value="1">

                            <button type="submit" class="btn btn-primary d-grid w-100" id="registerButton">
                                Sign up
                            </button>
                        </form>

                        <p class="text-center">
                            <a href="{{ url('/login') }}">
                                <span>Sign in instead</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="successToast" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                User Successfully Registered!
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="failedToast" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                User Successfully Registered!
            </div>
        </div>
    </div>
@endsection
