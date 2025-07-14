<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\SaleItem;
use App\Models\Banner;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Item::all());
    }

    public function showBanner(Request $request)
    {
        return response()->json(Banner::where('is_active', true)->get());
    }

    public function newArrival(Request $request)
    {
        $limit = $request->query('limit', 10);
        $newArrivalItems = Item::where('created_at', '>=', now()->subDays(30))->take($limit)->get();
        return response()->json($newArrivalItems);
    }

    public function trending(Request $request)
    {
        $limit = $request->query('limit', 10);
        $trendingItems = SaleItem::query()
            ->join('sales', 'sales.id', '=', 'sale_items.sale_id')
            ->join('items', 'items.id', '=', 'sale_items.item_id')
            ->where('sales.created_at', '>=', now()->subDays(30))
            ->select('items.id', 'items.name', 'items.photo', 'items.price', DB::raw('SUM(sale_items.quantity) as total_sold'))
            ->groupBy('items.id', 'items.name', 'items.photo', 'items.price')
            ->orderByDesc('total_sold')
            ->take($limit)
            ->get();

        return response()->json($trendingItems);
    }

    
}
