@extends('layouts/contentNavbarLayout')
@section('title', 'Ticket Type View')

@section('page-script')
    @vite(['resources/js/service/back/ticketType/ticketType_view.js'])
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">
            View All Data Type Ticket
            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ticketTypeModal">
                    Add Type Ticket
                </button>
            </div>
        </h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered" id="ticketTypeTable">
                    <thead>
                        <tr>
                            <th><b>ID</b></th>
                            <th><b>Clubhouse</b></th>
                            <th><b>Type Ticket</b></th>
                            <th><b>Name</b></th>
                            <th><b>Price</b></th>
                            <th><b>Duration</b></th>
                            <th><b>Status</b></th>
                            <th><b>Created At</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="loadingRow">
                            <td colspan="9" class="text-center">
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
        <div class="modal fade" id="ticketTypeModal" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog">
                <form id="ticketTypeForm" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ticketTypeModalTitle">Add Type Ticket Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="clubhouseSelect" class="form-label">Clubhouse</label>
                                <select id="clubhouseSelect" class="form-select">
                                    <option value="">Select Clubhouse</option>
                                    <!-- Options will be dynamically loaded here -->
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="typeticketSelect" class="form-label">Type Ticket</label>
                                <select id="typeticketSelect" class="form-select" required>
                                    <option value="">Select Type Ticket</option>
                                    <option value="1">Regular</option>
                                    <option value="2">Member</option>
                                    <option value="3">Package</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="nameTicket" class="form-label">Name</label>
                                <input type="text" id="nameTicket" class="form-control" placeholder="Enter Name Ticket"
                                    required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" id="price" class="form-control" placeholder="Enter Price"
                                    required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="duration" class="form-label">Duration</label>
                                <input type="number" id="duration" class="form-control"
                                    placeholder="Enter Duration ( Days )" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="statusTicketType" class="form-label">Status</label>
                                <select id="statusTicketType" class="form-select" required>
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveTicketTypeBtn" style="width: 100px">
                            <span id="saveTicketTypeBtnText">Save</span>
                            <span id="saveTicketTypeBtnSpinner" class="spinner-border spinner-border-sm d-none"
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
                        <p>Are you sure you want to delete this Ticket ?</p>
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
