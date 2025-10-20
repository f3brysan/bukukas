@extends('layouts.app')

@section('title', 'Categories Management')
@section('description', 'Manage your income and expense categories')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Categories Management</h4>
                        <button type="button" class="btn btn-primary" onclick="createCategory()">
                            <i class="mdi mdi-plus me-1"></i>
                            Add Category
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="categoriesTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Category Modal -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createCategoryForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="create_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="create_name" name="name" required>
                            <div class="invalid-feedback" id="create_name_error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="create_type" class="form-label">Category Type</label>
                            <select class="form-select" id="create_type" name="type" required>
                                <option value="">Select Type</option>
                                <option value="income">Income</option>
                                <option value="expense">Expense</option>
                            </select>
                            <div class="invalid-feedback" id="create_type_error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm d-none" id="create_spinner"></span>
                            Create Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editCategoryForm">
                    <input type="hidden" id="edit_category_id" name="category_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                            <div class="invalid-feedback" id="edit_name_error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_type" class="form-label">Category Type</label>
                            <select class="form-select" id="edit_type" name="type" required>
                                <option value="">Select Type</option>
                                <option value="income">Income</option>
                                <option value="expense">Expense</option>
                            </select>
                            <div class="invalid-feedback" id="edit_type_error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm d-none" id="edit_spinner"></span>
                            Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategoryModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this category? This action cannot be undone.</p>
                    <p class="text-muted">Note: Categories with associated transactions cannot be deleted.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                        <span class="spinner-border spinner-border-sm d-none" id="delete_spinner"></span>
                        Delete Category
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        let categoriesTable;
        let categoryToDelete = null;

        $(document).ready(function() {
            // Initialize DataTable
            categoriesTable = $('#categoriesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('categories.index') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'type_badge',
                        name: 'type',
                        orderable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [1, 'asc']
                ],
                pageLength: 10,
                responsive: true,
                language: {
                    processing: "Loading...",
                    emptyTable: "No categories found",
                    zeroRecords: "No matching categories found"
                }
            });

            // Create category form submission
            $('#createCategoryForm').on('submit', function(e) {
                e.preventDefault();

                const spinner = $('#create_spinner');
                const submitBtn = $(this).find('button[type="submit"]');

                spinner.removeClass('d-none');
                submitBtn.prop('disabled', true);

                // Clear previous errors
                clearFormErrors('create');

                $.ajax({
                    url: "{{ route('categories.store') }}",
                    type: 'POST',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#createCategoryModal').modal('hide');
                            categoriesTable.ajax.reload();
                            toastr.success(response.message);
                            $('#createCategoryForm')[0].reset();
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            showFormErrors('create', errors);
                        } else {
                            toastr.error('An error occurred while creating the category');
                        }
                    },
                    complete: function() {
                        spinner.addClass('d-none');
                        submitBtn.prop('disabled', false);
                    }
                });
            });

            // Edit category form submission
            $('#editCategoryForm').on('submit', function(e) {
                e.preventDefault();

                const categoryId = $('#edit_category_id').val();
                const spinner = $('#edit_spinner');
                const submitBtn = $(this).find('button[type="submit"]');

                spinner.removeClass('d-none');
                submitBtn.prop('disabled', true);

                // Clear previous errors
                clearFormErrors('edit');

                $.ajax({
                    url: `/categories/${categoryId}`,
                    type: 'PUT',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#editCategoryModal').modal('hide');
                            categoriesTable.ajax.reload();
                            toastr.success(response.message);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            showFormErrors('edit', errors);
                        } else {
                            toastr.error('An error occurred while updating the category');
                        }
                    },
                    complete: function() {
                        spinner.addClass('d-none');
                        submitBtn.prop('disabled', false);
                    }
                });
            });

            // Delete confirmation
            $('#confirmDeleteBtn').on('click', function() {
                if (categoryToDelete) {
                    const spinner = $('#delete_spinner');
                    const deleteBtn = $(this);

                    spinner.removeClass('d-none');
                    deleteBtn.prop('disabled', true);

                    $.ajax({
                        url: `/categories/${categoryToDelete}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#deleteCategoryModal').modal('hide');
                                categoriesTable.ajax.reload();
                                toastr.success(response.message);
                            }
                        },
                        error: function(xhr) {
                            const response = xhr.responseJSON;
                            toastr.error(response.message ||
                                'An error occurred while deleting the category');
                        },
                        complete: function() {
                            spinner.addClass('d-none');
                            deleteBtn.prop('disabled', false);
                            categoryToDelete = null;
                        }
                    });
                }
            });
        });

        // Global functions
        function createCategory() {
            $('#createCategoryModal').modal('show');
        }

        function editCategory(id) {
            $.ajax({
                url: `/categories/${id}/edit`,
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        $('#edit_category_id').val(response.data.id);
                        $('#edit_name').val(response.data.name);
                        $('#edit_type').val(response.data.type);
                        $('#editCategoryModal').modal('show');
                    }
                },
                error: function() {
                    toastr.error('Failed to load category data');
                }
            });
        }

        function deleteCategory(id) {
            categoryToDelete = id;
            $('#deleteCategoryModal').modal('show');
        }

        function clearFormErrors(formType) {
            $(`#${formType}_name`).removeClass('is-invalid');
            $(`#${formType}_type`).removeClass('is-invalid');
            $(`#${formType}_name_error`).text('');
            $(`#${formType}_type_error`).text('');
        }

        function showFormErrors(formType, errors) {
            if (errors.name) {
                $(`#${formType}_name`).addClass('is-invalid');
                $(`#${formType}_name_error`).text(errors.name[0]);
            }
            if (errors.type) {
                $(`#${formType}_type`).addClass('is-invalid');
                $(`#${formType}_type_error`).text(errors.type[0]);
            }
        }

        function showAlert(type, message) {
            const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;

            // Remove existing alerts
            $('.alert').remove();

            // Add new alert
            $('.card-body').prepend(alertHtml);

            // Auto-hide after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut();
            }, 5000);
        }
    </script>
@endpush
