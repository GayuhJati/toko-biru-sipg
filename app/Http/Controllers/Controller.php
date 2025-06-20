<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Transaction;

abstract class Controller
{
    public function index(Request $request)
    {
        $query = Item::query();

        if ($request->filled('start') && $request->filled('end')) {
            $query->whereBetween('created_at', [$request->start, $request->end]);
        }

        return view('inventory.index', ['items' => $query->get()]);
    }

    public function storeIn(Request $request)
    {
        Transaction::create([
            'item_id' => $request->item_id,
            'type' => 'in',
            'quantity' => $request->quantity,
            'user_id' => Auth::user()->id,
        ]);

        $item = Item::find($request->item_id);
        $item->increment('stock', $request->quantity);

        return back()->with('success', 'Barang masuk ditambahkan');
    }

    public function storeOut(Request $request)
    {
        Transaction::create([
            'item_id' => $request->item_id,
            'type' => 'out',
            'quantity' => $request->quantity,
            'user_id' => Auth::user()->id,
        ]);

        $item = Item::find($request->item_id);
        $item->decrement('stock', $request->quantity);

        return back()->with('success', 'Barang keluar dicatat');
    }
}
