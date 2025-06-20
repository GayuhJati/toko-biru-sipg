<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::with('item', 'user')->latest()->take(10)->get();
        return view('dashboard',compact('transactions'));
    }

    public function lineChart(Request $request)
    {
        if ($request->from && $request->to && $request->from > $request->to) {
            return response()->json(['message' => 'Tanggal awal tidak boleh lebih besar dari tanggal akhir'], 400);
        }

        $data = Sale::selectRaw('DATE(created_at) as date, SUM(total) as total_sales')
        ->when($request->from, function ($query) use ($request) {
            return $query->whereDate('created_at', '>=', $request->from);
        })
        ->when($request->to, function ($query) use ($request) {
            return $query->whereDate('created_at', '<=', $request->to);
        })
        ->groupByRaw('DATE(created_at)')
        ->orderBy('date')
        ->get();

        return response()->json($data);
    }
}
