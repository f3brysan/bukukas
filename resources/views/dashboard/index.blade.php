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
                        <h4 class="mb-2">30 Days Financial Overview</h4>                        
                    </div>
                </div>
                <div class="card-body">
                    <figure class="highcharts-figure ">
                        <div id="monthlyChart" class="highcharts-light"></div>                        
                    </figure>
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
                                <span class="fw-semibold">Rp.
                                    {{ number_format($category->total_expense, 0, ',', '.') }}</span>
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
                <input type="hidden" name="id" id="transactionId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="transactionModalLabel">Transaction</h5>
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

    <!-- Delete Transaction Modal -->
    <div class="modal fade" id="deleteTransactionModal" tabindex="-1" aria-labelledby="deleteTransactionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTransactionModalLabel">Delete Transaction</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this transaction?</p>
                </div>
                <form id="deleteTransactionForm">
                    <input type="hidden" name="id" id="deleteTransactionId">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
        integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets') }}/js/dashboards-ecommerce.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/themes/adaptive.js"></script>

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
            $('#transactionModalLabel').text('Add Transaction');
            $('#transactionForm button[type="submit"]').text('Add Transaction');
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

        function editTransaction(id) {
            $("#transactionForm").trigger("reset");
            $.ajax({
                url: "{{ route('transactions.edit', ['id' => ':id']) }}".replace(':id', id),
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('#transactionModal').modal('show');
                    $('#transactionModalLabel').text('Edit Transaction');
                    $('#transactionForm button[type="submit"]').text('Update Transaction');
                    $('#transactionForm select[name="type"]').val(response.data.type).trigger('change');
                    $('#transactionForm input[name="id"]').val(response.data.id);
                    $('#transactionForm textarea[name="description"]').val(response.data.description);
                    $('#transactionForm input[name="amount"]').val(response.data.amount).trigger('change').mask(
                        '000.000.000.000.000', {
                            reverse: true
                        });
                    $('#transactionForm input[name="date"]').val(response.data.date).trigger('change');
                    // Wait until the category options are loaded before setting the value
                    let checkAndSetCategory = function() {
                        // Check if category option is present yet
                        if ($('#transactionForm select[name="category_id"] option[value="' + response.data
                                .category_id + '"]').length) {
                            $('#transactionForm select[name="category_id"]').val(response.data.category_id)
                                .trigger('change');
                        } else {
                            // If not, try again after a short delay
                            setTimeout(checkAndSetCategory, 50);
                        }
                    };
                    checkAndSetCategory();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseJSON.message);
                    toastr.error(xhr.responseJSON.message);
                }
            });
        }

        function deleteTransaction(id) {
            $('#deleteTransactionModal').modal('show');
            $('#deleteTransactionModalLabel').text('Delete Transaction');
            $('#deleteTransactionId').val(id);
        }

        $("#deleteTransactionForm").on("submit", function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                url: "{{ route('transactions.delete') }}",
                type: 'POST',
                data: formData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#deleteTransactionForm button[type="submit"]').prop('disabled', true);
                },
                success: function(response) {
                    console.log(response);
                    toastr.success(response.message);
                    $('#deleteTransactionModal').modal('hide');
                    transactionsTable.ajax.reload();
                    $('#deleteTransactionForm button[type="submit"]').prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseJSON.message);
                    toastr.error(xhr.responseJSON.message);
                    $('#deleteTransactionForm button[type="submit"]').prop('disabled', false);
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

    <script>
        Highcharts.chart('monthlyChart', {
            chart: {
                type: 'line'
            },

            title: {
                text: 'Daily Financial Overview',
                align: 'center'
            },

            subtitle: {
                text: 'Income vs Expense Trends',
                align: 'left'
            },

            yAxis: {
                title: {
                    text: 'Amount (Rp)'
                },
                labels: {
                    formatter: function() {
                        return 'Rp ' + Highcharts.numberFormat(this.value, 0, ',', '.');
                    }
                }
            },

            xAxis: {
                type: 'datetime',
                title: {
                    text: 'Date'
                },
                labels: {
                    formatter: function() {
                        return Highcharts.dateFormat('%d %b', this.value);
                    }
                },
                accessibility: {
                    rangeDescription: 'Date range'
                }
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    }
                }
            },

            tooltip: {
                shared: true,
                crosshairs: true,
                formatter: function() {
                    let tooltip = '<b>' + Highcharts.dateFormat('%d %b %Y', this.x) + '</b><br/>';
                    this.points.forEach(function(point) {
                        tooltip += '<span style="color:' + point.color + '">●</span> ' + 
                                   point.series.name + ': <b>Rp ' + 
                                   Highcharts.numberFormat(point.y, 0, ',', '.') + '</b><br/>';
                    });
                    return tooltip;
                }
            },

            series: [
                {
                    name: 'Income',
                    data: [
                        @foreach($monthlyChart['chart'] as $data)
                        [Date.parse('{{ $data->date }}'), {{ $data->total_income }}],
                        @endforeach
                    ],
                    color: '#28a745'
                },
                {
                    name: 'Expense',
                    data: [
                        @foreach($monthlyChart['chart'] as $data)
                        [Date.parse('{{ $data->date }}'), {{ $data->total_expense }}],
                        @endforeach
                    ],
                    color: '#dc3545'
                }
            ],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    </script>
@endpush
