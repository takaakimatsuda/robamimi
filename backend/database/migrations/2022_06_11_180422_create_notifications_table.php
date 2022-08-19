<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->cascadeOnDelete()->comment('通知を受け取ったユーザーのID')->nullable(false);
            $table->integer('comment_id')->comment('コメントのID')->nullable();
            $table->integer('like_id')->comment('いいねのID')->nullable();
            $table->timestamp('read_at')->comment('通知を読んだ時刻')->nullable();
            $table->timestamps();

			// 削除処理はソフトデリートであることを定義
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
