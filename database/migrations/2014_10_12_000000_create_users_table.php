<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email')->unique();
            $table->string('password');
			$table->string('icon')->nullable();
			$table->string('token')->nullable();
			$table->boolean('twitter')->default(false);
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
		Schema::dropIfExists('threads');
		Schema::dropIfExists('user_tokens');
        Schema::dropIfExists('users');
    }
}
