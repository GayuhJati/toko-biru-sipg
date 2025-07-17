<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|max:2048',
        ]);

        $file = $request->file('upload');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('uploads', $file, $filename);
        $storepath = 'uploads/' . $filename;
        $url = asset('storage/' . $storepath);

        // $file = $request->file('upload');
        // $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        // Storage::disk('public')->putFile('uploads', $file, $filename);
        // $path = $file->store('uploads', 'public');
        // $url = asset('storage/' . $path);

        return response()->json(['uploaded' => true,'url' => $url]);
    }
}
