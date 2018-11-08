<?php

namespace App\Observers;

use App\Models\Link;
use Cache;

class LinkObserver
{
    public function saved(Link $link)
    {
    	// SEO 优化 slug
        Cache::forget($link->cache_key);
    }

}