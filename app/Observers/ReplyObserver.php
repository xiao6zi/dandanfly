<?php

namespace App\Observers;

use App\Models\Reply;


class ReplyObserver
{


    // creating, created, updating, updated, saving,
    // saved,  deleting, deleted, restoring, restored

    public function created(Reply $reply)
    {
        $reply->article->increment('reply_count', 1);
    }

    public function creating(Reply $reply)
    {
        $reply->body = clean($reply->body);
    }

}