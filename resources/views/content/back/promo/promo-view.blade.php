@extends('layouts/contentNavbarLayout')
@section('title', 'Promo View')

@section('page-script')
    @vite(['resources/js/service/back/promo/promo_view.js'])
@endsection
@section('content')
<div class="card">
    <h5 class="card-header">
        View All Data Promo
        <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#promoModal">
                Add Promo
            </button>
        </div>
    </h5>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered" id="promoTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Max Discount</th>
                        <th>Min Order Value</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="loadingRow">
                        <td colspan="11" class="text-center">
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
    <div class="modal fade" id="promoModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form id="promoForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="promoModalTitle">Add Promo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-12 mb-3">
                        <label for="promoName" class="form-label">Name</label>
                        <input type="text" id="promoName" name="name" class="form-control" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="promoCode" class="form-label">Code</label>
                        <input type="text" id="promoCode" name="code" class="form-control" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="promoType" class="form-label">Type</label>
                        <select id="promoType" name="type" class="form-select" required>
                            <option value="">Select Type</option>
                            <option value="1">Percentage</option>
                            <option value="2">Fixed</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="promoValue" class="form-label">Value</label>
                        <input type="number" id="promoValue" name="value" class="form-control" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="promoMaxDiscount" class="form-label">Max Discount</label>
                        <input type="number" id="promoMaxDiscount" name="max_discount" class="form-control">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="promoMinOrder" class="form-label">Min Order Value</label>
                        <input type="number" id="promoMinOrder" name="min_order_value" class="form-control">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="promoStartDate" class="form-label">Start Date</label>
                        <input type="datetime-local" id="promoStartDate" name="start_date" class="form-control" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="promoEndDate" class="form-label">End Date</label>
                        <input type="datetime-local" id="promoEndDate" name="end_date" class="form-control" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="promoStatus" class="form-label">Status</label>
                        <select id="promoStatus" name="status" class="form-select" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="savePromoBtn" style="width: 100px">
                        <span id="savePromoBtnText">Save</span>
                        <span id="savePromoBtnSpinner" class="spinner-border spinner-border-sm d-none"
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
                    <p>Are you sure you want to delete this Clubhouse ?</p>
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