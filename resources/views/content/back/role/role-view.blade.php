@extends('layouts/contentNavbarLayout')
@section('title', 'Role View')

@section('page-script')
    @vite(['resources/js/service/back/role/role_view.js'])
@endsection

@section('content')
    <!-- Bordered Table -->
    <div class="card">
        <h5 class="card-header">
            View All Data Role
            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#backDropModal">
                    Add Role
                </button>
            </div>
        </h5>
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

        <div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog">
                <form id="roleForm" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="backDropModalTitle">Add Role Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBackdrop" class="form-label">Role Name</label>
                                <input type="text" id="nameBackdrop" class="form-control" placeholder="Enter Role Name" required>
                            </div>
                            <div class="col mb-3">
                                <label for="statusBackdrop" class="form-label">Status</label>
                                <select id="statusBackdrop" class="form-select" required>
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveRoleBtn">
                            <span id="saveRoleBtnText">Save</span>
                            <span id="saveRoleBtnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <!-- Toast Container -->
    <div id="toastContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 11"></div>
    </div>
    <!--/ Bordered Table -->
@endsection