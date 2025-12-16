@extends('layouts.app')

@section('title', 'Export Report')
@section('description', 'Export transaction report to PDF')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="mdi mdi-file-pdf-box me-2"></i>
                            Export Transaction Report
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-alert-circle-outline me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-circle-outline me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="alert alert-info" role="alert">
                                <i class="mdi mdi-information-outline me-2"></i>
                                <strong>Info:</strong> Select a date range to generate a PDF report of your transactions grouped by category.
                            </div>

                            <form id="exportForm" method="GET" action="{{ route('export.pdf') }}">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="start_date" class="form-label">
                                            <i class="mdi mdi-calendar-start me-1"></i>
                                            Start Date
                                        </label>
                                        <input type="date" 
                                               class="form-control" 
                                               id="start_date" 
                                               name="start_date" 
                                               value="{{ request('start_date', \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d')) }}"
                                               required>
                                        <div class="form-text">Select the start date for the report</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="end_date" class="form-label">
                                            <i class="mdi mdi-calendar-end me-1"></i>
                                            End Date
                                        </label>
                                        <input type="date" 
                                               class="form-control" 
                                               id="end_date" 
                                               name="end_date" 
                                               value="{{ request('end_date', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                                               required>
                                        <div class="form-text">Select the end date for the report</div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="d-flex gap-2 flex-wrap">
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setDateRange('today')">
                                                <i class="mdi mdi-calendar-today me-1"></i>
                                                Today
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setDateRange('yesterday')">
                                                <i class="mdi mdi-calendar-clock me-1"></i>
                                                Yesterday
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setDateRange('thisWeek')">
                                                <i class="mdi mdi-calendar-week me-1"></i>
                                                This Week
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setDateRange('lastWeek')">
                                                <i class="mdi mdi-calendar-week-begin me-1"></i>
                                                Last Week
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setDateRange('thisMonth')">
                                                <i class="mdi mdi-calendar-month me-1"></i>
                                                This Month
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setDateRange('lastMonth')">
                                                <i class="mdi mdi-calendar-month-outline me-1"></i>
                                                Last Month
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setDateRange('thisYear')">
                                                <i class="mdi mdi-calendar-year me-1"></i>
                                                This Year
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted">
                                            <i class="mdi mdi-information-outline me-1"></i>
                                            The report will include all transactions within the selected date range, grouped by category.
                                        </small>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary" id="exportBtn">
                                            <i class="mdi mdi-file-pdf-box me-2"></i>
                                            <span class="spinner-border spinner-border-sm d-none me-2" id="exportSpinner"></span>
                                            Generate PDF Report
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="mdi mdi-help-circle-outline me-2"></i>
                                        What's included in the report?
                                    </h5>
                                    <ul class="mb-0">
                                        <li>All transactions within the selected date range</li>
                                        <li>Transactions grouped by category</li>
                                        <li>Sorted in ascending order by date</li>
                                        <li>Category-wise totals (income and expense)</li>
                                        <li>Overall summary with total income, expense, and net balance</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Validate date range on form submission
            $('#exportForm').on('submit', function(e) {
                const startDate = new Date($('#start_date').val());
                const endDate = new Date($('#end_date').val());

                if (startDate > endDate) {
                    e.preventDefault();
                    toastr.error('Start date cannot be later than end date');
                    return false;
                }

                // Show loading state
                $('#exportBtn').prop('disabled', true);
                $('#exportSpinner').removeClass('d-none');
            });

            // Set minimum date for end_date based on start_date
            $('#start_date').on('change', function() {
                const startDate = $(this).val();
                $('#end_date').attr('min', startDate);
            });

            // Set maximum date for start_date based on end_date
            $('#end_date').on('change', function() {
                const endDate = $(this).val();
                $('#start_date').attr('max', endDate);
            });

            // Initialize date constraints
            const today = new Date().toISOString().split('T')[0];
            $('#start_date').attr('max', today);
            $('#end_date').attr('max', today);
            
            // Set initial constraints based on current values
            const startDate = $('#start_date').val();
            const endDate = $('#end_date').val();
            if (startDate) {
                $('#end_date').attr('min', startDate);
            }
            if (endDate) {
                $('#start_date').attr('max', endDate);
            }
        });

        function setDateRange(range) {
            const today = new Date();
            let startDate, endDate;

            switch(range) {
                case 'today':
                    startDate = today;
                    endDate = today;
                    break;
                case 'yesterday':
                    const yesterday = new Date(today);
                    yesterday.setDate(yesterday.getDate() - 1);
                    startDate = yesterday;
                    endDate = yesterday;
                    break;
                case 'thisWeek':
                    const thisWeekStart = new Date(today);
                    thisWeekStart.setDate(today.getDate() - today.getDay());
                    startDate = thisWeekStart;
                    endDate = today;
                    break;
                case 'lastWeek':
                    const lastWeekStart = new Date(today);
                    lastWeekStart.setDate(today.getDate() - today.getDay() - 7);
                    const lastWeekEnd = new Date(lastWeekStart);
                    lastWeekEnd.setDate(lastWeekStart.getDate() + 6);
                    startDate = lastWeekStart;
                    endDate = lastWeekEnd;
                    break;
                case 'thisMonth':
                    startDate = new Date(today.getFullYear(), today.getMonth(), 1);
                    endDate = today;
                    break;
                case 'lastMonth':
                    const lastMonthStart = new Date(today.getFullYear(), today.getMonth() - 1, 1);
                    const lastMonthEnd = new Date(today.getFullYear(), today.getMonth(), 0);
                    startDate = lastMonthStart;
                    endDate = lastMonthEnd;
                    break;
                case 'thisYear':
                    startDate = new Date(today.getFullYear(), 0, 1);
                    endDate = today;
                    break;
                default:
                    return;
            }

            // Format dates as YYYY-MM-DD
            const formatDate = (date) => {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            };

            $('#start_date').val(formatDate(startDate));
            $('#end_date').val(formatDate(endDate));

            // Update constraints
            $('#end_date').attr('min', formatDate(startDate));
            $('#start_date').attr('max', formatDate(endDate));
        }
    </script>
@endpush

