<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesExport;

class SaleController extends Controller
{

    public function index(Request $request)
    {
        $sales = Sale::when($request->from, function ($query) use ($request) {
            return $query->whereDate('created_at', '>=', $request->from);
        })
        ->when($request->to, function ($query) use ($request) {
            return $query->whereDate('created_at', '<=', $request->to);
        })
        ->orderBy('created_at', 'desc')
        ->get();
        return view('report', compact('sales'));
    }
    // public function report(Request $request)
    // {
    //     $sales = Sale::query()
    //         ->when($request->start && $request->end, function ($query) use ($request) {
    //             $query->whereBetween('created_at', [$request->start, $request->end]);
    //         })->get();

    //     $chartData = $sales->groupBy(fn($s) => $s->created_at->format('Y-m-d'))
    //         ->map(fn($s) => $s->sum('total'));

    //     return view('sales.report', compact('chartData'));
    // }

    public function export(Request $request)
    {
        $date = now()->format('Y-m-d');
        return Excel::download(new SalesExport($request->from, $request->to), "laporan_penjualan_{$date}.xlsx");
    }
}
