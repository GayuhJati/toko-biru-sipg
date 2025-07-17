<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Article::where('is_published', true)->get());
    }

    public function showArticle($id)
    {
        // Logic to return a specific article by ID
    }

    public function store(Request $request)
    {
        // Logic to create a new article
    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing article
    }

    public function destroy($id)
    {
        // Logic to delete an article
    }
}
