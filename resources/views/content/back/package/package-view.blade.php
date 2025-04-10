@extends('layouts/contentNavbarLayout')

@section('title', 'Package View')

@section('page-script')
    @vite(['resources/js/service/back/package/package/package_view.js', 'resources/js/service/back/package/package_category/package_category_view.js'])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="nav-align-top nav-tabs-shadow mb-6">
                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#tab-package" aria-controls="tab-package" aria-selected="true"><span
                                class="d-none d-sm-block"><i
                                    class="tf-icons bx bx-package bx-sm me-1_5 align-text-bottom"></i> Package</span><i
                                class="bx bx-package bx-sm d-sm-none"></i></button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#tab-package-categories" aria-controls="tab-package-categories"
                            aria-selected="false"><span class="d-none d-sm-block"><i
                                    class="tf-icons bx bx-category bx-sm me-1_5 align-text-bottom"></i> Package
                                Categories</span><i class="bx bx-category bx-sm d-sm-none"></i></button>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- Tab Items -->
                    <div class="tab-pane fade show active" id="tab-package" role="tabpanel">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Package List</h5>
                                <button type="button" class="btn btn-primary" id="addpackageBtn"
                                    data-bs-target="#packageModal" data-bs-toggle="modal">
                                    <i class="bx bx-plus me-1"></i> Add New Package
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-bordered" id="packageTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Package Category</th>
                                                <th class="text-center">Package Name</th>
                                                <th class="text-center text-nowrap">Price</th>
                                                <th class="text-center">Duration</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Details</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="loadingRowItems">
                                                <td colspan="8" class="text-center">
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
                    <div class="tab-pane fade" id="tab-package-categories" role="tabpanel">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Package Categories List</h5>
                                <button type="button" class="btn btn-primary" id="addPackageCategoryBtn"
                                    data-bs-target="#packageCategoryModal" data-bs-toggle="modal">
                                    <i class="bx bx-plus me-1"></i> Add New Package Category
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-bordered" id="packageCategoryTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Category Name</th>
                                                <th>Type Category</th>
                                                <th>Created At</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="loadingRowCategories">
                                                <td colspan="6" class="text-center">
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


    <!-- Modal For Add or Edit Package-->
    <div class="modal fade" id="packageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="packageModalTitle">Add Package Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="packageForm">
                        <!-- Package Category -->
                        <div class="mb-3">
                            <label for="categorySelect" class="form-label">Category</label>
                            <select id="categorySelect" class="form-select" required>
                                <option value="">Select Category</option>
                                <!-- Options will be dynamically loaded here -->
                            </select>
                        </div>

                        <!-- Package Name -->
                        <div class="mb-3">
                            <label for="packageName" class="form-label">Package Name</label>
                            <input type="text" class="form-control" id="packageName"
                                placeholder="Input Name Package" />
                        </div>

                        <!-- Price -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" placeholder="Input Price" />
                        </div>

                        <!-- Duration -->
                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration</label>
                            <input type="text" class="form-control" id="duration" placeholder="Input Duration" />
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="statusPackage" class="form-label">Select Status</label>
                            <select class="form-select" id="statusPackage">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <!-- Pills Tabs -->
                        <div class="mb-3">
                            <ul class="nav nav-pills mb-3" id="package-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="ticket-tab" data-bs-toggle="pill"
                                        data-bs-target="#ticket-tab-pane" type="button" role="tab"
                                        aria-controls="ticket-tab-pane" aria-selected="true">
                                        <i class="bx bx-ticket bx-sm me-1_5 align-text-bottom"></i> Ticket
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="item-tab" data-bs-toggle="pill"
                                        data-bs-target="#item-tab-pane" type="button" role="tab"
                                        aria-controls="item-tab-pane" aria-selected="false">
                                        <i class="bx bx-box bx-sm me-1_5 align-text-bottom"></i> Item
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="package-tabContent">
                                <div class="tab-pane fade show active" id="ticket-tab-pane" role="tabpanel"
                                    aria-labelledby="ticket-tab" tabindex="0">
                                    <div class="border rounded p-3" style="height: 300px; overflow-y: auto;">
                                        <p class="text-muted mb-2 fw-semibold">All Ticket List</p>
                                        <div class="list-group" id="ticket-list"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="item-tab-pane" role="tabpanel" aria-labelledby="item-tab"
                                    tabindex="0">
                                    <div class="border rounded p-3" style="height: 300px; overflow-y: auto;">
                                        <p class="text-muted mb-2 fw-semibold">All Item List</p>
                                        <div class="list-group" id="item-list"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal For Add or Edit Package Category-->
    <div class="modal fade" id="packageCategoryModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form id="packageCategoryForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="packageCategoryModalTitle">Add Package Category Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="namePackageCategory" class="form-label">Name</label>
                            <input type="text" id="namePackageCategory" class="form-control"
                                placeholder="Enter Name Package Category" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="typeCategory" class="form-label">Type Category</label>
                            <select id="typeCategory" class="form-select">
                                <option value="">Select Type Category</option>
                                <option value="1">Ticket</option>
                                <option value="2">Member</option>
                                <option value="3">Items</option>
                                <option value="4">All</option>
                            </select>
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
                    <button type="submit" class="btn btn-primary" id="savePackageCategoryBtn" style="width: 100px">
                        <span id="savePackageCategoryBtnText">Save</span>
                        <span id="savePackageCategoryBtnSpinner" class="spinner-border spinner-border-sm d-none"
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
                    <p>Are you sure you want to delete this Data ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div id="toastContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 11"></div>
@endsection

<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
    id="offcanvasScroll" aria-labelledby="offcanvasScrollLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasScrollLabel" class="offcanvas-title">Package Details</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0" id="packageDetailsContent">
        <div class="text-center py-5 text-muted">
            <i class="bi bi-box2 fs-1"></i>
            <p class="mt-3">Select a package to view its details.</p>
        </div>
    </div>
</div>
