<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Transaction;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        // $transactions = Transaction::with('item')
        //     ->when($from, fn($query) => $query->whereDate('created_at', '>=', $from))
        //     ->when($to, fn($query) => $query->whereDate('created_at', '<=', $to))
        //     ->orderByDesc('created_at')
        //     ->get();

        $items = Item::when($request->from, fn($q) =>
        $q->whereDate('created_at', '>=', $from))
            ->when($request->to, fn($q) =>
            $q->whereDate('created_at', '<=', $to))
            ->orderBy('created_at', 'desc')
            ->get();

        // dd($items);

        return view('inventory.index', compact('items', 'from', 'to'));
    }

    public function create(Request $request)
    {
        $items = Item::all();
        $selectedItem = $request->query('item'); // misalnya item=3
        $type = $request->query('type'); // misalnya type=in
        return view('inventory.create', compact('items','selectedItem', 'type'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
        ]);

        $item = Item::findOrFail($validated['item_id']);

        if ($validated['type'] === 'in') {
            $item->increment('stock', $validated['quantity']);
        } else {
            if ($item->stock < $validated['quantity']) {
                return back()->withErrors(['quantity' => 'Stok tidak mencukupi']);
            }
            $item->decrement('stock', $validated['quantity']);
        }

        $validated['user_id'] = Auth::user()->id;
        Transaction::create($validated);

        return redirect()->route('inventory.index')->with('success', 'Transaksi berhasil ditambahkan');
    }
}
