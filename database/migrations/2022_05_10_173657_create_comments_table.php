<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
				$table->foreignId('thread_id')->comment('スレッド番号')->constrained();
				$table->foreignId('user_id')->cascadeOnDelete()->comment('ユーザーのID')->constrained();
				$table->string('contents', 1000)->comment('コメント内容');
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
        Schema::dropIfExists('comments');
    }
}
