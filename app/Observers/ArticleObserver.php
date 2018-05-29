<?php

namespace App\Observers;

use App\Models\Article;
use Parsedown;
use App\Jobs\TranslateSlug;

class ArticleObserver
{
    public function saving(Article $article)
    {
        $markdownParser = new Parsedown();
        $convertedHtml = $markdownParser->setBreaksEnabled(true)->text($article->body_original);
        $article->body = clean($convertedHtml);
    }

    public function saved(Article $article)
    {
    	// SEO 优化 slug
        TranslateSlug::dispatch($article);
    }

}