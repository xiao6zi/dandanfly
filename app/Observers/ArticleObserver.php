<?php

namespace App\Observers;

use App\Models\Article;
use Parsedown;

class ArticleObserver
{
    public function saving(Article $article)
    {
        $markdownParser = new Parsedown();
        $convertedHmtl = $markdownParser->setBreaksEnabled(true)->text($article->body_original);
        $article->body = $convertedHmtl;
//        $article->body = clean($convertedHmtl);
    }

}