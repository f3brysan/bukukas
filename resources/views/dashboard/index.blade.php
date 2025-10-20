@extends('layouts.app')

@section('title', 'Dashboard')
@section('description', 'Bukukas Financial Dashboard')

@section('content')
<div class="row gy-4 mb-4">
 
</div>

<div class="row gy-4 mb-4">
  <!-- Recent Transactions -->
  <div class="col-lg-8">
    <div class="card h-100">
      <div class="card-header">
        <div class="d-flex justify-content-between">
          <h4 class="mb-2">Recent Transactions</h4>
          <div class="dropdown">
            <button
              class="btn p-0"
              type="button"
              id="transactionsDropdown"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false">
              <i class="mdi mdi-dots-vertical mdi-24px"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionsDropdown">
              <a class="dropdown-item" href="javascript:void(0);">View All</a>
              <a class="dropdown-item" href="javascript:void(0);">Export</a>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Description</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Type</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Salary Payment</td>
                <td>Income</td>
                <td class="text-success">+$5,000</td>
                <td>2024-01-15</td>
                <td><span class="badge bg-success">Income</span></td>
              </tr>
              <tr>
                <td>Grocery Shopping</td>
                <td>Food</td>
                <td class="text-danger">-$150</td>
                <td>2024-01-14</td>
                <td><span class="badge bg-danger">Expense</span></td>
              </tr>
              <tr>
                <td>Freelance Work</td>
                <td>Income</td>
                <td class="text-success">+$800</td>
                <td>2024-01-13</td>
                <td><span class="badge bg-success">Income</span></td>
              </tr>
              <tr>
                <td>Electricity Bill</td>
                <td>Utilities</td>
                <td class="text-danger">-$120</td>
                <td>2024-01-12</td>
                <td><span class="badge bg-danger">Expense</span></td>
              </tr>
              <tr>
                <td>Online Course</td>
                <td>Education</td>
                <td class="text-danger">-$299</td>
                <td>2024-01-11</td>
                <td><span class="badge bg-danger">Expense</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Actions -->
  <div class="col-lg-4">
    <div class="card h-100">
      <div class="card-header">
        <h4 class="mb-2">Quick Actions</h4>
      </div>
      <div class="card-body">
        <div class="d-grid gap-3">
          <a href="#" class="btn btn-success">
            <i class="mdi mdi-cash-plus me-2"></i>
            Add Income
          </a>
          <a href="#" class="btn btn-danger">
            <i class="mdi mdi-cash-minus me-2"></i>
            Add Expense
          </a>
          <a href="#" class="btn btn-primary">
            <i class="mdi mdi-chart-line me-2"></i>
            View Reports
          </a>
          <a href="#" class="btn btn-secondary">
            <i class="mdi mdi-cog me-2"></i>
            Settings
          </a>
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
            <button
              class="btn p-0"
              type="button"
              id="chartDropdown"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false">
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
        <h4 class="mb-2">Category Breakdown</h4>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="d-flex align-items-center">
            <div class="avatar me-2">
              <div class="avatar-initial bg-label-primary rounded">
                <i class="mdi mdi-food mdi-20px"></i>
              </div>
            </div>
            <span>Food & Dining</span>
          </div>
          <span class="fw-semibold">$1,250</span>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="d-flex align-items-center">
            <div class="avatar me-2">
              <div class="avatar-initial bg-label-warning rounded">
                <i class="mdi mdi-car mdi-20px"></i>
              </div>
            </div>
            <span>Transportation</span>
          </div>
          <span class="fw-semibold">$800</span>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="d-flex align-items-center">
            <div class="avatar me-2">
              <div class="avatar-initial bg-label-info rounded">
                <i class="mdi mdi-home mdi-20px"></i>
              </div>
            </div>
            <span>Housing</span>
          </div>
          <span class="fw-semibold">$2,100</span>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="d-flex align-items-center">
            <div class="avatar me-2">
              <div class="avatar-initial bg-label-success rounded">
                <i class="mdi mdi-school mdi-20px"></i>
              </div>
            </div>
            <span>Education</span>
          </div>
          <span class="fw-semibold">$450</span>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <div class="avatar me-2">
              <div class="avatar-initial bg-label-danger rounded">
                <i class="mdi mdi-medical-bag mdi-20px"></i>
              </div>
            </div>
            <span>Healthcare</span>
          </div>
          <span class="fw-semibold">$320</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets') }}/js/dashboards-ecommerce.js"></script>
<script>
  // Initialize monthly chart
  document.addEventListener('DOMContentLoaded', function() {
    // Chart initialization code would go here
    console.log('Dashboard loaded successfully');
  });
</script>
@endpush