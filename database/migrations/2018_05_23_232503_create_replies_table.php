<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('source')->nullable()->index()->comment('评论来源：ios, android, pc');
            $table->integer('article_id')->unsigned()->default(0)->index()->comment('文章ID');
            $table->integer('user_id')->unsigned()->default(0)->index()->comment('用户ID');
            $table->enum('is_blocked', ['yes',  'no'])->default('no')->index()->comment('是否已屏蔽');
            $table->integer('vote_count')->default(0)->index()->comment('点赞次数');
            $table->text('body')->comment('回复内容(markdown经过转换成html)');
            $table->text('body_original')->nullable()->comment('原始回复内容');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
}
