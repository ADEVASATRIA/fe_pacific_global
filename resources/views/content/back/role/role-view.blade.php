@extends('layouts/contentNavbarLayout')
@section('title', 'Role View')

@section('page-script')
    @vite(['resources/js/service/back/role/role_view.js'])
@endsection

@section('content')
<!-- Bordered Table -->
<div class="card">
    <h5 class="card-header">View All Data Role</h5>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered" id="roleTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role Name</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="loadingRow">
                        <td colspan="5" class="text-center">
                            <div class="spinner-border text-success" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--/ Bordered Table -->
@endsection