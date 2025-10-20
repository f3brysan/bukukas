<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $transactionsController = new TransactionController();
        $mostExpenseCategories = $transactionsController->getMostExpenseCategories();
        
        return view('dashboard.index', compact('categories', 'mostExpenseCategories'));
    }
}
