<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Str;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Item::count() === 0) {
            $this->command->warn("Tidak ada item tersedia. Harap isi tabel items terlebih dahulu.");
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            $sale = Sale::create([
                'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
                'user_id' => 4, 
                'total' => 0,
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now(),
            ]);

            $items = Item::inRandomOrder()->take(rand(1, 4))->get();
            $total = 0;

            foreach ($items as $item) {
                $qty = rand(1, 5);
                $price = $item->price;
                $subtotal = $qty * $price;

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'item_id' => $item->id,
                    'quantity' => $qty,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);

                $total += $subtotal;
            }

            $sale->update([
                'total' => $total,
            ]);
        }
    }
}
