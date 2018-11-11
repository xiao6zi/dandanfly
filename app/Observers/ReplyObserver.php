<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\ArticleReplied;

class ReplyObserver
{


    // creating, created, updating, updated, saving,
    // saved,  deleting, deleted, restoring, restored

    public function created(Reply $reply)
    {
        $article = $reply->article;
        $reply->article->increment('reply_count', 1);

        $article->user->notify(new ArticleReplied($reply));
    }

    public function creating(Reply $reply)
    {
        $reply->body = clean($reply->body);
    }

}