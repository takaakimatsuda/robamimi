<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->id();
			$table->foreignId('user_id')->cascadeOnDelete()->comment('ユーザーのID')->constrained();
			$table->string('title', 140)->comment('スレッドタイトル');
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
		Schema::dropIfExists('genres');
		Schema::dropIfExists('threads');
    }
}
