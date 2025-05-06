@extends('layouts/contentNavbarLayout')

@section('title', 'Ticket Type View')

@section('page-script')
    @vite(['resources/js/service/back/clubhouse/clubhouse_view.js'])
@endsection
@section('content')
    <div class="card">
        <h5 class="card-header">
            View All Data Clubhouse
            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#clubhouseModal">
                    Add Clubhouse
                </button>
            </div>
        </h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered" id="clubhouseTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="loadingRow">
                            <td colspan="7" class="text-center">
                                <div class="spinner-border text-success" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal For Add or Edit-->
        <div class="modal fade" id="clubhouseModal" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog">
                <form id="clubhouseForm" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clubhouseModalTitle">Add Clubhouse Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="nameClubhouse" class="form-label">Name</label>
                                <input type="text" id="nameClubhouse" class="form-control"
                                    placeholder="Enter Name Clubhouse" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" id="location" class="form-control" placeholder="Enter Location"
                                    required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" id="phone" class="form-control" placeholder="Enter Phone"
                                    required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" class="form-select" required>
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveClubhouseBtn" style="width: 100px">
                            <span id="saveClubhouseBtnText">Save</span>
                            <span id="saveClubhouseBtnSpinner" class="spinner-border spinner-border-sm d-none"
                                role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal For Confirm Detele --}}
        <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this Promo Data ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Container -->
        <div id="toastContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 11"></div>
    </div>

@endsection
