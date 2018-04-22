<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

class ArticlesController extends Controller
{

    public function __contrust()
    {
        $this->middleware('auth', ['only' => ['index', 'show']]);
    }

    public function index(Request $request, Article $article)
    {
        $articles = $article->withOrder($request->order)->paginate(20);
        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function create(Request $request)
    {
        return view('articles.create_and_edit');
    }
}
