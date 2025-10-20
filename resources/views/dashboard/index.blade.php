@extends('layouts.app')

@section('title', 'Dashboard')
@section('description', 'Bukukas Financial Dashboard')

@section('content')
    <div class="row gy-4 mb-4">

    </div>

    <div class="row gy-4 mb-4">
        <!-- Recent Transactions -->
        <div class="col-lg-12">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-2">Recent Transactions</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-12 d-flex justify-content-end">
                            <a href="javascript:void(0);" onclick="addTransaction()" class="btn btn-outline-primary">
                                <i class="mdi mdi-cash-plus me-2"></i>
                                Add Transaction
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover" id="transactionsTable">
                            <thead>
                                <tr>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row gy-4 mb-4">
        <!-- Monthly Chart -->
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-2">Monthly Financial Overview</h4>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="chartDropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical mdi-24px"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="chartDropdown">
                                <a class="dropdown-item" href="javascript:void(0);">Download</a>
                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="monthlyChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>

        <!-- Category Breakdown -->
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="mb-2">Most Expense Categories</h4>
                </div>
                <div class="card-body">
                    @if ($mostExpenseCategories['success'])
                        @foreach ($mostExpenseCategories['categories'] as $category)
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-2">
                                        <div class="avatar-initial bg-label-danger rounded">
                                            <i class="mdi mdi-cash-minus mdi-20px"></i>
                                        </div>
                                    </div>
                                    <span>{{ $category->name }}</span>
                                </div>
                                <span class="fw-semibold">Rp. {{ number_format($category->total_expense, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-danger">
                            {{ $mostExpenseCategories['message'] }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Income Modal -->
    <div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="transactionForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="transactionModalLabel">Add Transaction</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Description -->
                        <div class="mb-3">
                            <label for="transactionDescription" class="form-label">Description</label>
                            <small class="text-muted">Enter a description for the transaction</small>
                            <textarea class="form-control" id="transactionDescription" name="description"
                                placeholder="Enter transaction description" required></textarea>

                        </div>
                        <!-- Type -->
                        <div class="mb-3">
                            <label for="transactionType" class="form-label">Type</label>
                            <select id="transactionType" name="type" class="form-select" required>
                                <option value="" disabled selected>Select type</option>
                                <option value="income">Income</option>
                                <option value="expense">Expense</option>
                            </select>
                        </div>
                        <!-- Category -->
                        <div class="mb-3">
                            <label for="transactionCategory" class="form-label">Category</label>
                            <select id="transactionCategory" name="category_id" class="form-select" required>
                                <option value="" disabled selected>Select category</option>
                            </select>
                        </div>
                        <!-- Amount -->
                        <div class="mb-3">
                            <label for="transactionAmount" class="form-label">Amount</label>
                            <input type="text" class="form-control transaction-amount" id="transactionAmount"
                                name="amount" placeholder="Enter amount" required>
                        </div>
                        <!-- Date -->
                        <div class="mb-3">
                            <label for="transactionDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="transactionDate" name="date"
                                value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Transaction</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
        integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets') }}/js/dashboards-ecommerce.js"></script>

    <script>
        let transactionsTable;
        let transactionToDelete = null;
        $(document).ready(function() {
            $('.transaction-amount').mask('000.000.000.000.000', {
                reverse: true
            });

            transactionsTable = $('#transactionsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('transactions.get') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'category.name',
                        name: 'category.name',
                        className: 'text-center'
                    },
                    {
                        data: 'amount',
                        name: 'amount',
                        className: 'text-end'
                    },
                    {
                        data: 'date',
                        name: 'date',
                        className: 'text-center'
                    },
                    {
                        data: 'type_badge',
                        name: 'type_badge',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    }
                ],
                order: [
                    [3, 'desc']
                ],
                pageLength: 10,
                responsive: true,
                language: {
                    processing: "Loading...",
                    emptyTable: "No categories found",
                    zeroRecords: "No matching categories found"
                }
            });
        });

        function addTransaction() {
            $('#transactionModal').modal('show');
        }

        $("#transactionForm").on("submit", function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                url: "{{ route('transactions.store') }}",
                type: 'POST',
                data: formData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#transactionForm button[type="submit"]').prop('disabled', true);
                },
                success: function(response) {
                    console.log(response);
                    toastr.success(response.message);
                    $('#transactionModal').modal('hide');
                    transactionsTable.ajax.reload();
                    $('#transactionForm button[type="submit"]').prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseJSON.message);
                    toastr.error(xhr.responseJSON.message);
                    $('#transactionForm button[type="submit"]').prop('disabled', false);
                }
            });
        });

        $("#transactionType").on("change", function() {
            let type = $(this).val();
            $('#transactionCategory').html('<option value="" disabled selected>Loading...</option>');
            $.ajax({
                url: "{{ route('categories.get.type', ['type' => ':type']) }}".replace(':type', type),
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('#transactionCategory').html(
                        '<option value="" disabled selected>Select category</option>');
                    response.data.forEach(function(category) {
                        $('#transactionCategory').append('<option value="' + category.id +
                            '">' + category.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseJSON.message);
                    toastr.error(xhr.responseJSON.message);
                    $('#transactionCategory').html(
                        '<option value="" disabled selected>Select category</option>');
                }
            });
        })
    </script>
@endpush
