@extends('layouts/contentNavbarLayout')

@section('title', 'Item Management')

@section('page-script')
    @vite(['resources/js/service/back/item/item_view.js', 'resources/js/service/back/item/item_category/item_category_view.js'])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="nav-align-top nav-tabs-shadow mb-6">
                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#tab-items" aria-controls="tab-items" aria-selected="true"><span
                                class="d-none d-sm-block"><i
                                    class="tf-icons bx bx-package bx-sm me-1_5 align-text-bottom"></i> Items</span><i
                                class="bx bx-package bx-sm d-sm-none"></i></button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#tab-item-categories" aria-controls="tab-item-categories"
                            aria-selected="false"><span class="d-none d-sm-block"><i
                                    class="tf-icons bx bx-category bx-sm me-1_5 align-text-bottom"></i> Item
                                Categories</span><i class="bx bx-category bx-sm d-sm-none"></i></button>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- Tab Items -->
                    <div class="tab-pane fade show active" id="tab-items" role="tabpanel">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Items List</h5>
                                <button type="button" class="btn btn-primary" id="addItemBtn" data-bs-target="#itemModal"
                                    data-bs-toggle="modal">
                                    <i class="bx bx-plus me-1"></i> Add New Item
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-bordered" id="itemTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Item Name</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="loadingRowItems">
                                                <td colspan="7" class="text-center">
                                                    <div class="spinner-border text-success" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Data will be loaded dynamically -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Item Categories -->
                    <div class="tab-pane fade" id="tab-item-categories" role="tabpanel">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Item Categories List</h5>
                                <button type="button" class="btn btn-primary" id="addCategoryBtn"
                                    data-bs-target="#itemCategoryModal" data-bs-toggle="modal">
                                    <i class="bx bx-plus me-1"></i> Add New Category
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-bordered" id="categoryTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Category Name</th>
                                                <th>Created At</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="loadingRowCategories">
                                                <td colspan="5" class="text-center">
                                                    <div class="spinner-border text-success" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Data will be loaded dynamically -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add or Edit Item Category -->
    <div class="modal fade" id="itemCategoryModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg"> <!-- Tambahkan modal-lg agar lebih lebar -->
            <form id="itemCategoryForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemCategoryModalTitle">Add Item Category Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="nameCategory" class="form-label">Name</label>
                            <input type="text" id="nameCategory" class="form-control"
                                placeholder="Enter Item Category Name" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" class="form-control" rows="4" placeholder="Enter Item Category Description" required></textarea>
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
                    <button type="submit" class="btn btn-primary" id="saveItemCategoryBtn">
                        <span id="saveItemCategoryBtnText">Save</span>
                        <span id="saveItemCategoryBtnSpinner" class="spinner-border spinner-border-sm d-none"
                            role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Add or Edit Item Category -->
    <div class="modal fade" id="itemModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg"> <!-- Tambahkan modal-lg agar lebih lebar -->
            <form id="itemForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemModalTitle">Add Item Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="categorySelect" class="form-label">Category</label>
                            <select id="categorySelect" class="form-select" required>
                                <option value="">Select Category</option>
                                <!-- Options will be dynamically loaded here -->
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="nameItem" class="form-label">Name</label>
                            <input type="text" id="nameItem" class="form-control" placeholder="Enter Name Item"
                                required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" id="price" class="form-control" placeholder="Enter Price"
                                required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" id="stock" class="form-control" placeholder="Enter Stock"
                                required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="statusItem" class="form-label">Status</label>
                            <select id="statusItem" class="form-select" required>
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveItemBtn">
                        <span id="saveItemBtnText">Save</span>
                        <span id="saveItemBtnSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                            aria-hidden="true"></span>
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
                    <p>Are you sure you want to delete this Item?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Toast for notifications -->
    <div class="bs-toast toast fade bg-success" role="alert" aria-live="assertive" aria-atomic="true"
        id="toastNotification">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold" id="toastTitle">Notification</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toastMessage"></div>
    </div>

@endsection
