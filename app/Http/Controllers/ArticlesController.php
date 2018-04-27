<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Models\Category;
use App\Models\Article;
use Auth;

class ArticlesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
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

    public function create(Category $category, Article $article)
    {
        $categories = $category->all();
        return view('articles.create_and_edit', compact('categories', 'article'));
    }

    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = Auth::id();
        $article->save();
        return redirect()->to($article->link())->with('success', '文章创建成功');
    }

    public function edit(Category $category, Article $article)
    {
        $this->authorize('update', $article);
        $categories = $category->all();
        return view('articles.create_and_edit', compact('categories', 'article'));
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);
        $article->update($request->all());
        return redirect()->to($article->link())->with('success', '文章修改成功');
    }

    public function destroy(Article $article)
    {
        $this->authorize('destroy', $article);
        $article->delete();
    }
}
