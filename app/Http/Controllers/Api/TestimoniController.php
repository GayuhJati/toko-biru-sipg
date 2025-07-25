<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimoni;

class TestimoniController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => Testimoni::where('is_active', true, now()->subDays(30))->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $testimonial = Testimoni::create($validated);

        return response()->json([
            'success' => true,
            'data' => $testimonial,
        ], 201);
    }
}
