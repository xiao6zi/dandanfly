<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Models\Category;
use App\Models\Article;
use App\Models\User;
use App\Models\Link;
use Auth;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request, Article $article, User $user, Link $link)
    {
        $articles = $article->withOrder($request->order)->paginate(20);
        $active_users = $user->getActiveUsers();
        $links = $link->getAllCached();
        return view('articles.index', compact('articles', 'active_users', 'links'));
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
        // test git-flow
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
        return redirect()->route('articles.index')->with('message', '成功删除！');
    }

    public function upload()
    {
        $disk = Storage::disk('qiniu');

        $fileContents = file_get_contents($_FILES['image']['tmp_name']);
        $ext = array_search($_FILES['image']['type'], [
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ], true);
        $name = date('YmdHis') . str_random(6) . '.' . $ext;

        $result = $disk->put($name, $fileContents);

        if ($result) {
            $url = $disk->getUrl($name);
            return response()->json(['name' => $name, 'url' => $url]);
        } else {
            return response()->json('上传失败');
        }

    }
}
