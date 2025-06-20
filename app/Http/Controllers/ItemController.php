<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    public function create()
    {
        return view('inventory.create-item');
    }

    public function edit(Item $item)
    {
        return view('inventory.create-item', compact('item'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string',
            'sku' => 'required|string|unique:items,sku',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);
        $price = str_replace('.', '', $request->price);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/items', $filename);
            $storepath = 'items/' . $filename;
        }

        Item::create([
            'name' => $request->name,
            'photo' => $storepath ?? null,
            'sku' => $request->sku,
            'price' => (int) str_replace('.', '', $request->price),
            'stock' => $request->stock,
        ]);

        return redirect()->route('pegawai.items.create')->with('success', 'Barang baru berhasil ditambahkan!');
    }

    public function update(Request $request, Item $item)
    {
        $request->merge([
            'price' => str_replace('.', '', $request->price),
        ]);

        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string',
            'sku' => 'required|string|unique:items,sku,' . $item->id,
            'price' => 'required|numeric',
        ]);


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/items', $filename);
            $storepath = 'items/' . $filename;
        }

        $item->update([
            'name' => $request->name,
            'sku' => $request->sku,
            'price' => $request->price,
            'photo' => $storepath ?? $item->photo,
        ]);

        return redirect()->route('pegawai.items.index')->with('success', 'Item berhasil diperbarui.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('pegawai.items.index')->with('success', 'Item berhasil dihapus.');
    }
}
