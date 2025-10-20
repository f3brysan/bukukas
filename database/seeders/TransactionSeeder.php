<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first user (assuming test user exists)
        $user = User::first();
        if (!$user) {
            $this->command->error('No user found. Please run UserSeeder first.');
            return;
        }

        // Get all categories
        $categories = Category::all();
        if ($categories->isEmpty()) {
            $this->command->error('No categories found. Please run CategorySeeder first.');
            return;
        }

        // Sample transaction data with Indonesian Rupiah amounts
        $transactions = [
            // Income Transactions (in IDR)
            [
                'description' => 'Gaji Bulanan',
                'amount' => 15000000.00, // 15 million IDR
                'date' => Carbon::now()->subDays(5),
                'type' => 'income',
                'category_name' => 'Salary'
            ],
            [
                'description' => 'Proyek Web Development Freelance',
                'amount' => 5000000.00, // 5 million IDR
                'date' => Carbon::now()->subDays(3),
                'type' => 'income',
                'category_name' => 'Freelance'
            ],
            [
                'description' => 'Dividen Saham',
                'amount' => 2500000.00, // 2.5 million IDR
                'date' => Carbon::now()->subDays(1),
                'type' => 'income',
                'category_name' => 'Investment'
            ],
            [
                'description' => 'Pendapatan Bisnis Sampingan',
                'amount' => 8000000.00, // 8 million IDR
                'date' => Carbon::now()->subDays(2),
                'type' => 'income',
                'category_name' => 'Business'
            ],
            [
                'description' => 'Uang Hadiah Ulang Tahun',
                'amount' => 1000000.00, // 1 million IDR
                'date' => Carbon::now()->subDays(7),
                'type' => 'income',
                'category_name' => 'Gift'
            ],

            // Expense Transactions (in IDR)
            [
                'description' => 'Belanja Bulanan di Supermarket',
                'amount' => 850000.00, // 850k IDR
                'date' => Carbon::now()->subDays(1),
                'type' => 'expense',
                'category_name' => 'Food & Dining'
            ],
            [
                'description' => 'Kartu Transportasi Bulanan',
                'amount' => 350000.00, // 350k IDR
                'date' => Carbon::now()->subDays(4),
                'type' => 'expense',
                'category_name' => 'Transportation'
            ],
            [
                'description' => 'Sewa Rumah',
                'amount' => 5000000.00, // 5 million IDR
                'date' => Carbon::now()->subDays(6),
                'type' => 'expense',
                'category_name' => 'Housing'
            ],
            [
                'description' => 'Tagihan Listrik',
                'amount' => 450000.00, // 450k IDR
                'date' => Carbon::now()->subDays(3),
                'type' => 'expense',
                'category_name' => 'Utilities'
            ],
            [
                'description' => 'Kunjungan Dokter',
                'amount' => 750000.00, // 750k IDR
                'date' => Carbon::now()->subDays(2),
                'type' => 'expense',
                'category_name' => 'Healthcare'
            ],
            [
                'description' => 'Langganan Kursus Online',
                'amount' => 299000.00, // 299k IDR
                'date' => Carbon::now()->subDays(5),
                'type' => 'expense',
                'category_name' => 'Education'
            ],
            [
                'description' => 'Tiket Bioskop',
                'amount' => 150000.00, // 150k IDR
                'date' => Carbon::now()->subDays(1),
                'type' => 'expense',
                'category_name' => 'Entertainment'
            ],
            [
                'description' => 'Belanja Pakaian',
                'amount' => 1200000.00, // 1.2 million IDR
                'date' => Carbon::now()->subDays(4),
                'type' => 'expense',
                'category_name' => 'Shopping'
            ],
            [
                'description' => 'Premi Asuransi Mobil',
                'amount' => 2500000.00, // 2.5 million IDR
                'date' => Carbon::now()->subDays(7),
                'type' => 'expense',
                'category_name' => 'Insurance'
            ],
            [
                'description' => 'Alat Kantor',
                'amount' => 250000.00, // 250k IDR
                'date' => Carbon::now()->subDays(2),
                'type' => 'expense',
                'category_name' => 'Miscellaneous'
            ],

            // Additional transactions for more data
            [
                'description' => 'Makan Malam di Restoran',
                'amount' => 450000.00, // 450k IDR
                'date' => Carbon::now()->subDays(3),
                'type' => 'expense',
                'category_name' => 'Food & Dining'
            ],
            [
                'description' => 'Ojek Online',
                'amount' => 25000.00, // 25k IDR
                'date' => Carbon::now()->subDays(1),
                'type' => 'expense',
                'category_name' => 'Transportation'
            ],
            [
                'description' => 'Pendapatan Kerja Part-time',
                'amount' => 2000000.00, // 2 million IDR
                'date' => Carbon::now()->subDays(4),
                'type' => 'income',
                'category_name' => 'Freelance'
            ],
            [
                'description' => 'Kedai Kopi',
                'amount' => 35000.00, // 35k IDR
                'date' => Carbon::now()->subDays(2),
                'type' => 'expense',
                'category_name' => 'Food & Dining'
            ],
            [
                'description' => 'Keanggotaan Gym',
                'amount' => 400000.00, // 400k IDR
                'date' => Carbon::now()->subDays(6),
                'type' => 'expense',
                'category_name' => 'Healthcare'
            ],
            [
                'description' => 'Pembelian Buku',
                'amount' => 180000.00, // 180k IDR
                'date' => Carbon::now()->subDays(5),
                'type' => 'expense',
                'category_name' => 'Education'
            ],
            [
                'description' => 'Langganan Netflix',
                'amount' => 186000.00, // 186k IDR
                'date' => Carbon::now()->subDays(7),
                'type' => 'expense',
                'category_name' => 'Entertainment'
            ],
            [
                'description' => 'Bonus Karyawan',
                'amount' => 3000000.00, // 3 million IDR
                'date' => Carbon::now()->subDays(8),
                'type' => 'income',
                'category_name' => 'Salary'
            ],
            [
                'description' => 'Isi Bensin',
                'amount' => 200000.00, // 200k IDR
                'date' => Carbon::now()->subDays(3),
                'type' => 'expense',
                'category_name' => 'Transportation'
            ],
            [
                'description' => 'Apotek',
                'amount' => 150000.00, // 150k IDR
                'date' => Carbon::now()->subDays(1),
                'type' => 'expense',
                'category_name' => 'Healthcare'
            ],
            [
                'description' => 'Return Investasi',
                'amount' => 1200000.00, // 1.2 million IDR
                'date' => Carbon::now()->subDays(6),
                'type' => 'income',
                'category_name' => 'Investment'
            ],
            [
                'description' => 'Makan Siang dengan Teman',
                'amount' => 200000.00, // 200k IDR
                'date' => Carbon::now()->subDays(2),
                'type' => 'expense',
                'category_name' => 'Food & Dining'
            ],
            [
                'description' => 'Perawatan Rumah',
                'amount' => 1500000.00, // 1.5 million IDR
                'date' => Carbon::now()->subDays(9),
                'type' => 'expense',
                'category_name' => 'Housing'
            ],
            [
                'description' => 'Tagihan Air',
                'amount' => 180000.00, // 180k IDR
                'date' => Carbon::now()->subDays(4),
                'type' => 'expense',
                'category_name' => 'Utilities'
            ],
            [
                'description' => 'Belanja Online',
                'amount' => 650000.00, // 650k IDR
                'date' => Carbon::now()->subDays(5),
                'type' => 'expense',
                'category_name' => 'Shopping'
            ],
            [
                'description' => 'Fee Konsultasi',
                'amount' => 3500000.00, // 3.5 million IDR
                'date' => Carbon::now()->subDays(7),
                'type' => 'income',
                'category_name' => 'Business'
            ],
            [
                'description' => 'Hadiah Pernikahan',
                'amount' => 500000.00, // 500k IDR
                'date' => Carbon::now()->subDays(10),
                'type' => 'expense',
                'category_name' => 'Miscellaneous'
            ],
            [
                'description' => 'Cashback Reward',
                'amount' => 100000.00, // 100k IDR
                'date' => Carbon::now()->subDays(8),
                'type' => 'income',
                'category_name' => 'Gift'
            ],

            // Additional Indonesian-style transactions
            [
                'description' => 'Warung Makan',
                'amount' => 25000.00, // 25k IDR
                'date' => Carbon::now()->subDays(1),
                'type' => 'expense',
                'category_name' => 'Food & Dining'
            ],
            [
                'description' => 'Gojek/Grab',
                'amount' => 15000.00, // 15k IDR
                'date' => Carbon::now()->subDays(2),
                'type' => 'expense',
                'category_name' => 'Transportation'
            ],
            [
                'description' => 'Pendapatan Toko Online',
                'amount' => 12000000.00, // 12 million IDR
                'date' => Carbon::now()->subDays(3),
                'type' => 'income',
                'category_name' => 'Business'
            ],
            [
                'description' => 'Bensin Motor',
                'amount' => 50000.00, // 50k IDR
                'date' => Carbon::now()->subDays(1),
                'type' => 'expense',
                'category_name' => 'Transportation'
            ],
            [
                'description' => 'Pulsa dan Paket Data',
                'amount' => 100000.00, // 100k IDR
                'date' => Carbon::now()->subDays(4),
                'type' => 'expense',
                'category_name' => 'Utilities'
            ],
            [
                'description' => 'Kuliah Online',
                'amount' => 1500000.00, // 1.5 million IDR
                'date' => Carbon::now()->subDays(6),
                'type' => 'expense',
                'category_name' => 'Education'
            ],
            [
                'description' => 'Spotify Premium',
                'amount' => 55000.00, // 55k IDR
                'date' => Carbon::now()->subDays(7),
                'type' => 'expense',
                'category_name' => 'Entertainment'
            ],
            [
                'description' => 'THR (Tunjangan Hari Raya)',
                'amount' => 8000000.00, // 8 million IDR
                'date' => Carbon::now()->subDays(12),
                'type' => 'income',
                'category_name' => 'Salary'
            ],
            [
                'description' => 'Parkir Mall',
                'amount' => 10000.00, // 10k IDR
                'date' => Carbon::now()->subDays(2),
                'type' => 'expense',
                'category_name' => 'Transportation'
            ],
            [
                'description' => 'Obat-obatan',
                'amount' => 75000.00, // 75k IDR
                'date' => Carbon::now()->subDays(1),
                'type' => 'expense',
                'category_name' => 'Healthcare'
            ],
            [
                'description' => 'Reksadana',
                'amount' => 3000000.00, // 3 million IDR
                'date' => Carbon::now()->subDays(5),
                'type' => 'income',
                'category_name' => 'Investment'
            ],
            [
                'description' => 'Nasi Padang',
                'amount' => 30000.00, // 30k IDR
                'date' => Carbon::now()->subDays(3),
                'type' => 'expense',
                'category_name' => 'Food & Dining'
            ],
            [
                'description' => 'Kontrakan',
                'amount' => 2500000.00, // 2.5 million IDR
                'date' => Carbon::now()->subDays(8),
                'type' => 'expense',
                'category_name' => 'Housing'
            ],
            [
                'description' => 'WiFi Rumah',
                'amount' => 300000.00, // 300k IDR
                'date' => Carbon::now()->subDays(5),
                'type' => 'expense',
                'category_name' => 'Utilities'
            ],
            [
                'description' => 'Toko Pakaian',
                'amount' => 800000.00, // 800k IDR
                'date' => Carbon::now()->subDays(4),
                'type' => 'expense',
                'category_name' => 'Shopping'
            ],
            [
                'description' => 'Jasa Desain Grafis',
                'amount' => 4000000.00, // 4 million IDR
                'date' => Carbon::now()->subDays(6),
                'type' => 'income',
                'category_name' => 'Freelance'
            ],
            [
                'description' => 'Sedekah',
                'amount' => 200000.00, // 200k IDR
                'date' => Carbon::now()->subDays(11),
                'type' => 'expense',
                'category_name' => 'Miscellaneous'
            ],
            [
                'description' => 'Hadiah Lebaran',
                'amount' => 1500000.00, // 1.5 million IDR
                'date' => Carbon::now()->subDays(9),
                'type' => 'income',
                'category_name' => 'Gift'
            ]
        ];

        foreach ($transactions as $transactionData) {
            // Find the category by name
            $category = $categories->where('name', $transactionData['category_name'])->first();
            
            if ($category) {
                Transaction::create([
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                    'description' => $transactionData['description'],
                    'amount' => $transactionData['amount'],
                    'date' => $transactionData['date'],
                    'type' => $transactionData['type'],
                ]);
            }
        }

        $this->command->info('Transaction dummy data created successfully!');
    }
}