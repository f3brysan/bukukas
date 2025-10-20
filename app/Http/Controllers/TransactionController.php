<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    public function getTransactions(Request $request)
    {
        try {
            if ($request->ajax()) {
                $transactions = Transaction::with('category')->get();

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
}
