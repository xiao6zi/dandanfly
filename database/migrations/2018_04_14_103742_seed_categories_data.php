<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name' => '前端',
                'description' => '前端开发技术文章、前端资源分享推荐等'
            ],
            [
                'name' => 'PHP',
                'description' => 'PHP技术分享、开发心得、Bug解决等'
            ],
            [
                'name' => 'Linux',
                'description' => '服务端环境安装搭建、工具分享等'
            ],
            [
                'name' => '公告',
                'description' => '网站公告、通知等重要信息的发布'
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}
