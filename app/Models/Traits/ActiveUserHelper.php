<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use App\Models\Reply;
use Carbon\Carbon;

trait ActiveUserHelper
{
    /**
     * 系统 每一个小时 计算一次，统计 最近 7 天 所有用户发的 帖子数 和 评论数，
     * 用户每发一个帖子则得 4 分，每发一个回复得 1 分，计算出所有人的『得分』后再倒序，
     * 排名前八的用户将会显示在「活跃用户」列表里。
     */

    private $pass_days = 500; // 时间区间
    private $users = []; // 结果用户
    private $article_weight = 4; // 帖子权重
    private $reply_weight = 1; // 回复权重
    private $active_user_number = 8; // 个数

    private $cache_active_users_key = 'larabbs_active_users';
    protected $cache_expire_in_minutes = 65;

    public function getActiveUsers()
    {
        return Cache::remember($this->cache_active_users_key, $this->cache_expire_in_minutes, function () {
            return $this->calculateActiveUsers();
        });
    }

    public function calculateActiveUsers()
    {
        // 找出 7 天内 发过帖子的用户
        // 找出 7 天内 评论过的用户
        // 合并找出排名前 8 的用户
        // 更新缓存

        $this->calculateArticleScore();
        $this->calculateReplyScore();


        // 数组按照得分排序
        $users = array_sort($this->users, function ($user) {
            return $user['score'];
        });

        // 我们需要的是倒序，高分靠前，第二个参数为保持数组的 KEY 不变
        $users = array_reverse($users, true);

        // 只获取我们想要的数量
        $users = array_slice($users, 0, $this->active_user_number, true);

        // 新建一个空集合
        $active_users = collect();

        foreach ($users as $user_id => $user) {
            // 找寻下是否可以找到用户
            $user = $this->find($user_id);

            // 如果数据库里有该用户的话
            if ($user) {

                // 将此用户实体放入集合的末尾
                $active_users->push($user);
            }
        }

        $this->updateCacheActiveUsers($active_users);

        // 返回数据
        return $active_users;
    }

    private function calculateArticleScore()
    {
        $article_users = Article::query()->select(DB::raw('user_id, count(*) as article_count'))
                ->where('created_at', '>=', Carbon::now()->subDays($this->pass_days))
                ->groupBy('user_id')
                ->get();

        foreach ($article_users as $_item) {
            $this->users[$_item->user_id]['score'] = $_item->article_count * $this->article_weight;
        }

    }

    private function calculateReplyScore()
    {
        $reply_users = Reply::query()->select(DB::raw('user_id, count(*) as reply_count'))
            ->where('created_at', '>=', Carbon::now()->subDays($this->pass_days))
            ->groupBy('user_id')
            ->get();

        foreach ($reply_users as $_item) {
            if (isset($this->users[$_item->user_id])) {
                $this->users[$_item->user_id]['score'] += $_item->reply_count * $this->reply_weight;
            } else {
                $this->users[$_item->user_id]['score'] = $_item->reply_count * $this->reply_weight;
            }
        }

    }

    private function updateCacheActiveUsers($users)
    {
        Cache::put($this->cache_active_users_key, $users, $this->cache_expire_in_minutes);
    }

}
