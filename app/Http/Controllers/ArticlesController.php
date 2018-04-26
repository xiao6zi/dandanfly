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

    public function create(Category $category)
    {
        $categories = $category->all();
        return view('articles.create_and_edit', compact('categories'));
    }

    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = Auth::id();
        $article->save();
        return redirect()->to($article->link())->with('success', '文章创建成功');
    }

    public function update()
    {

    }

    public function edit()
    {

    }

    public function destroy(Article $article)
    {
        $article->delete();
    }
}
