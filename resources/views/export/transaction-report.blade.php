<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Report</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10px;
            color: #333;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #333;
        }

        .header h1 {
            font-size: 20px;
            margin-bottom: 5px;
            color: #2c3e50;
        }

        .header p {
            font-size: 11px;
            color: #666;
        }

        .report-info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }

        .report-info p {
            margin: 3px 0;
            font-size: 10px;
        }

        .category-section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }

        .category-header {
            background-color: #3498db;
            color: white;
            padding: 8px 12px;
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 10px;
            border-radius: 4px 4px 0 0;
        }

        .category-header.expense {
            background-color: #e74c3c;
        }

        .category-header.income {
            background-color: #27ae60;
        }

        .transactions-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 9px;
        }

        .transactions-table th {
            background-color: #ecf0f1;
            padding: 8px;
            text-align: left;
            font-weight: bold;
            border-bottom: 2px solid #bdc3c7;
        }

        .transactions-table td {
            padding: 6px 8px;
            border-bottom: 1px solid #ecf0f1;
        }

        .transactions-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .category-summary {
            text-align: right;
            padding: 8px 12px;
            background-color: #ecf0f1;
            font-weight: bold;
            font-size: 10px;
            border-radius: 0 0 4px 4px;
        }

        .category-summary .income {
            color: #27ae60;
        }

        .category-summary .expense {
            color: #e74c3c;
        }

        .total-section {
            margin-top: 30px;
            padding: 15px;
            background-color: #2c3e50;
            color: white;
            border-radius: 4px;
        }

        .total-section h3 {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            font-size: 11px;
        }

        .total-row.total {
            font-size: 13px;
            font-weight: bold;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
        }

        .amount {
            text-align: right;
            font-weight: bold;
        }

        .type-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
        }

        .type-badge.income {
            background-color: #d4edda;
            color: #155724;
        }

        .type-badge.expense {
            background-color: #f8d7da;
            color: #721c24;
        }

        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 8px;
            color: #666;
        }

        @page {
            margin: 15mm;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>BUKU KAS - TRANSACTION REPORT</h1>
        <p>Financial Transaction Report by Category</p>
    </div>

    <div class="report-info">
        <p><strong>User:</strong> {{ $user->name }}</p>
        <p><strong>Period:</strong> {{ $start_date }} to {{ $end_date }}</p>
        <p><strong>Generated:</strong> {{ $generated_at }}</p>
    </div>

    @if(count($categories_data) > 0)
        @foreach($categories_data as $categoryData)
            <div class="category-section">
                <div class="category-header {{ $categoryData['category']->type }}">
                    {{ $categoryData['category']->name }} 
                    <span style="float: right; font-size: 10px;">
                        ({{ strtoupper($categoryData['category']->type) }})
                    </span>
                </div>

                <table class="transactions-table">
                    <thead>
                        <tr>
                            <th style="width: 15%;">Date</th>
                            <th style="width: 45%;">Description</th>
                            <th style="width: 15%;">Type</th>
                            <th style="width: 25%;" class="amount">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categoryData['transactions'] as $transaction)
                            <tr>
                                <td>{{ $transaction->formatted_date }}</td>
                                <td>{{ $transaction->description }}</td>
                                <td>
                                    <span class="type-badge {{ $transaction->type }}">
                                        {{ strtoupper($transaction->type) }}
                                    </span>
                                </td>
                                <td class="amount">
                                    Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="category-summary">
                    @if($categoryData['total_income'] > 0)
                        <span class="income">Total Income: Rp {{ number_format($categoryData['total_income'], 0, ',', '.') }}</span>
                    @endif
                    @if($categoryData['total_expense'] > 0)
                        <span class="expense">Total Expense: Rp {{ number_format($categoryData['total_expense'], 0, ',', '.') }}</span>
                    @endif
                </div>
            </div>
        @endforeach

        <div class="total-section">
            <h3>SUMMARY</h3>
            <div class="total-row">
                <span>Total Income:</span>
                <span class="amount">Rp {{ number_format($total_income, 0, ',', '.') }}</span>
            </div>
            <div class="total-row">
                <span>Total Expense:</span>
                <span class="amount">Rp {{ number_format($total_expense, 0, ',', '.') }}</span>
            </div>
            <div class="total-row total">
                <span>Net Balance:</span>
                <span class="amount">Rp {{ number_format($net_balance, 0, ',', '.') }}</span>
            </div>
        </div>
    @else
        <div style="text-align: center; padding: 40px; color: #999;">
            <p style="font-size: 14px;">No transactions found for the selected date range.</p>
        </div>
    @endif

    <div class="footer">
        <p>This report was generated automatically by Buku Kas System</p>
    </div>
</body>
</html>

