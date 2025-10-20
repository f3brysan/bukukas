<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function getTransactions(Request $request)
    {
        try {
            if ($request->ajax()) {
                $transactions = Transaction::with('category')->where('user_id', auth()->user()->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

                return DataTables::of($transactions)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<button type="button" class="btn btn-sm btn-primary me-1" onclick="editTransaction('.$row->id.')">
                                    <i class="mdi mdi-pencil"></i>
                                </button>';
                        $btn .= '<button type="button" class="btn btn-sm btn-danger" onclick="deleteTransaction('.$row->id.')">
                                    <i class="mdi mdi-delete"></i>
                                </button>';
                        return $btn;
                    })
                    ->editColumn('amount', function ($row) {
                        return 'Rp. ' . number_format($row->amount, 0, ',', '.');
                    })
                    ->editColumn('date', function ($row) {
                        return Carbon::parse($row->date)->format('d-m-Y');
                    })
                    ->addColumn('type_badge', function ($row) {
                        $badgeClass = $row->type === 'income' ? 'success' : 'danger';
                        return '<span class="badge bg-'.$badgeClass.'">'.ucfirst($row->type).'</span>';
                    })
                    ->rawColumns(['action', 'type_badge'])
                    ->make(true);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch transactions',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function storeTransaction(Request $request)
    {
        try {
            $amount = str_replace('.', '', $request->amount);                  
            $transaction = Transaction::updateOrCreate([
                'id' => $request->id
            ], [
                'category_id' => $request->category_id,
                'user_id' => auth()->user()->id,
                'type' => $request->type,
                'amount' => $amount,
                'date' => $request->date,
                'description' => $request->description
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Transaction stored successfully',
                'data' => $transaction
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to store transaction',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function getMostExpenseCategories()
    {
        try {
            // Get sum of transactions by categories for current user, only for expense type, top 5
            // Note: Fix the column error by NOT filtering categories table by user_id, 
            // instead, filter transactions by user_id and type.
            // Get all categories with 'expense' type
            $categories = Category::where('type', 'expense')
                ->with(['transactions' => function ($query) {
                    $query->where('user_id', auth()->user()->id)
                        ->where('type', 'expense');
                }])
                ->get()
                ->map(function ($category) {
                    $sum = $category->transactions->sum('amount');
                    $category->total_expense = $sum;
                    return $category;
                })
                ->sortByDesc('total_expense')
                ->take(5)
                ->values();
            
            return [
                'success' => true,
                'message' => 'Most expense categories fetched successfully',
                'categories' => $categories                
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => 'Failed to get most expense categories',
                'error' => $th->getMessage(),
                'categories' => []
            ];
        }
    }

    public function getDailyChart()
    {
        try {
            $chart = Transaction::where('user_id', auth()->user()->id)
                ->select(
                    DB::raw('date(date) as date'),
                    DB::raw('CAST(SUM(amount) AS SIGNED) as total_amount'),
                    DB::raw('CAST(SUM(CASE WHEN type = "income" THEN amount ELSE 0 END) AS SIGNED) as total_income'),
                    DB::raw('CAST(SUM(CASE WHEN type = "expense" THEN amount ELSE 0 END) AS SIGNED) as total_expense')
                )
                ->groupBy('date')
                ->get();
            
            return [
                'success' => true,
                'message' => 'Monthly chart fetched successfully',
                'chart' => $chart
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => 'Failed to get monthly chart',
                'error' => $th->getMessage(),
                'chart' => []
            ];
        }
    }

    public function editTransaction($id)
    {
        try {
            $transaction = Transaction::find($id);
            $transaction->amount = number_format($transaction->amount, 0, ',', '.');
            return response()->json([
                'success' => true,
                'message' => 'Transaction fetched successfully',
                'data' => $transaction
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to edit transaction',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function deleteTransaction(Request $request)
    {
        try {
            $transaction = Transaction::find($request->id);
            if (!$transaction) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction not found'
                ], 404);
            }

            $transaction->delete();
            return response()->json([
                'success' => true,
                'message' => 'Transaction deleted successfully'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete transaction',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
                