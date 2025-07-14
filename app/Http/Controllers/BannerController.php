<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $banners = Banner::all();
        return view('dashboard', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('image');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        // $path = $file->storeAs('public/banners', $filename);
        Storage::disk('public')->putFileAs('banners', $file, $filename);
        $storepath = 'banners/' . $filename;

        Banner::create([
            'title' => $request->title,
            'image' => $storepath,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('banners.index')->with('success', 'Banner berhasil ditambahkan.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        $validator = Validator::make($request->all(), [
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

        $validator->after(function ($validator) use ($request) {
            if ($request->hasFile('image')) {
                $image = getimagesize($request->file('image'));
                if (!$image) return;

                $width = $image[0];
                $height = $image[1];

                // Rasio 16:9 = 1.777
                $ratio = round($width / $height, 3);

                if (abs($ratio - 1.777) > 0.01) {
                    $validator->errors()->add('image', 'Gambar harus memiliki rasio 16:9.');
                }
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = [
            'title' => $request->title,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('banners', $file, $filename);
            // $file->storeAs('public/banners', $filename);
            $data['image'] = 'banners/' . $filename;
        }

        $banner->update($data);

        return redirect()->route('banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        Storage::delete('public/'.$banner->image);
        $banner->delete();

        return back()->with('success', 'Banner berhasil dihapus.');
    }
}
