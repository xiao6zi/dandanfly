<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

class ArticlesController extends Controller
{
    public function index(Request $request, Article $article)
    {
        $articles = $article->paginate(20);
        return view('Articles.index', compact('articles'));
    }

    public function show()
    {

    }
}
