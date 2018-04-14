<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

class CategoriesController extends Controller
{
    public function show(Category $category, Article $article)
    {
        $articles = $article->where('category_id', $category->id)->paginate(20);

        return view('articles.index', compact('articles', 'category'));
    }
}
