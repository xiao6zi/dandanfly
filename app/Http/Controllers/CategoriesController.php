<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\User;
use App\Models\Link;

class CategoriesController extends Controller
{
    public function show(Category $category, Request $request, Article $article, User $user, Link $link)
    {
        $articles = $article->withOrder($request->order)
            ->where('category_id', $category->id)
            ->paginate(20);
        $active_users = $user->getActiveUsers();
        $links = $link->getAllCached();
        return view('articles.index', compact('articles', 'category', 'active_users', 'links'));
    }
}
