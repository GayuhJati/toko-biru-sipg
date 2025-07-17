<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function create()
    {
        return view('articles.create');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.create', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'photo' => 'nullable|image|max:2048',
        ]);

        $article->title = $validated['title'];
        $article->content = $validated['content'];

        if ($request->has('is_published')) {
            $article->is_published = true;
        } else {
            $article->is_published = false;
        }

        if ($request->hasFile('photo')) {
            if ($article->thumbnail && Storage::disk('public')->exists($article->photo)) {
                Storage::disk('public')->delete($article->thumbnail);
            }

            $file = $request->file('photo');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('uploads', $file, $filename);
            $storepath = 'uploads/' . $filename;
            $article->thumbnail = $storepath;
        }

        $article->save();

        return redirect()->route('dashboard', ['tab' => 'artikel'])->with('success', 'Artikel berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'content' => 'required|string',
            'is_published' => 'nullable|boolean',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('uploads', $file, $filename);
            $storepath = 'uploads/' . $filename;
            $validated['photo'] = $storepath;
        }

        $validated['is_published'] = $request->has('is_published');

        Article::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'thumbnail' => $validated['photo'],
            'content' => $validated['content'],
            'is_published' => $validated['is_published'],
        ]);

        return redirect()
            ->route('dashboard', ['tab' => 'artikel'])
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function destroy(Article $article)
    {
        if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        $article->delete();

        return redirect()->route('dashboard', ['tab' => 'artikel'])->with('success', 'Artikel berhasil dihapus.');
    }
}
