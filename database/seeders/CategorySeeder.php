<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Income Categories
            ['name' => 'Salary', 'type' => 'income'],
            ['name' => 'Freelance', 'type' => 'income'],
            ['name' => 'Investment', 'type' => 'income'],
            ['name' => 'Business', 'type' => 'income'],
            ['name' => 'Gift', 'type' => 'income'],
            
            // Expense Categories
            ['name' => 'Food & Dining', 'type' => 'expense'],
            ['name' => 'Transportation', 'type' => 'expense'],
            ['name' => 'Housing', 'type' => 'expense'],
            ['name' => 'Utilities', 'type' => 'expense'],
            ['name' => 'Healthcare', 'type' => 'expense'],
            ['name' => 'Education', 'type' => 'expense'],
            ['name' => 'Entertainment', 'type' => 'expense'],
            ['name' => 'Shopping', 'type' => 'expense'],
            ['name' => 'Insurance', 'type' => 'expense'],
            ['name' => 'Miscellaneous', 'type' => 'expense'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}