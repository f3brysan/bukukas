<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function index(Request $request)
    {
        return view('export.index');
    }

    public function exportPdf(Request $request)
    {
        try {
            // Get date range from request
            $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
            $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

            // Validate dates
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();

            // Get user's transactions within date range, sorted by date ascending
            $transactions = Transaction::with('category')
                ->where('user_id', auth()->user()->id)
                ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->orderBy('date', 'asc')
                ->orderBy('created_at', 'asc')
                ->get();

            // Group transactions by category
            $groupedTransactions = $transactions->groupBy('category_id');

            // Prepare data for each category
            $categoriesData = [];
            $totalIncome = 0;
            $totalExpense = 0;

            foreach ($groupedTransactions as $categoryId => $categoryTransactions) {
                $category = $categoryTransactions->first()->category;
                $categoryIncome = $categoryTransactions->where('type', 'income')->sum('amount');
                $categoryExpense = $categoryTransactions->where('type', 'expense')->sum('amount');

                // Format transaction dates
                $formattedTransactions = $categoryTransactions->map(function ($transaction) {
                    $transaction->formatted_date = Carbon::parse($transaction->date)->format('d-m-Y');
                    return $transaction;
                });

                $categoriesData[] = [
                    'category' => $category,
                    'transactions' => $formattedTransactions,
                    'total_income' => $categoryIncome,
                    'total_expense' => $categoryExpense,
                ];

                $totalIncome += $categoryIncome;
                $totalExpense += $categoryExpense;
            }

            // Sort categories by name
            usort($categoriesData, function ($a, $b) {
                return strcmp($a['category']->name, $b['category']->name);
            });

            // Prepare data for PDF
            $data = [
                'user' => auth()->user(),
                'start_date' => $startDate->format('d-m-Y'),
                'end_date' => $endDate->format('d-m-Y'),
                'generated_at' => Carbon::now()->format('d-m-Y H:i:s'),
                'categories_data' => $categoriesData,
                'total_income' => $totalIncome,
                'total_expense' => $totalExpense,
                'net_balance' => $totalIncome - $totalExpense,
            ];

            // Generate PDF
            $pdf = Pdf::loadView('export.transaction-report', $data);
            $pdf->setPaper('a4', 'portrait');

            // Generate filename with date range
            $filename = 'transaction-report-' . $startDate->format('Y-m-d') . '-to-' . $endDate->format('Y-m-d') . '.pdf';

            return $pdf->download($filename);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to generate PDF: ' . $e->getMessage());
        }
    }
}
