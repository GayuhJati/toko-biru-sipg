<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\User;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = Item::all();
        $user = User::first(); 

        foreach ($items as $item) {
            Transaction::create([
                'item_id' => $item->id,
                'type' => 'in',
                'quantity' => rand(10, 50),
                'user_id' => $user->id,
            ]);

            Transaction::create([
                'item_id' => $item->id,
                'type' => 'out',
                'quantity' => rand(1, 10),
                'user_id' => $user->id,
            ]);
        }
    }
}
