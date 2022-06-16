<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GoogleColumnsForUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('avatar')->nullable();
            $table->text('avatar_original')->nullable();
            $table->string('google_id')->nullable();
            $table->string('api_token')->nullable();
            $table->foreignId('position_id')->nullable()->constrained('positions');
            $table->string('password')->change()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('avatar');
            $table->dropColumn('avatar_original');
            $table->dropColumn('google_id');
            $table->dropColumn('api_token');
            $table->dropConstrainedForeignId('position_id');
        });
    }
}
