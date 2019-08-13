<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('birthday')->nullable()->after('name');
            $table->string('address')->nullable()->after('birthday');
            $table->string('last_login_ip')->after('remember_token')->nullable();
            $table->string('last_login_at')->after('last_login_ip')->nullable();
            $table->unsignedTinyInteger('type')
                ->after('password')
                ->comment('0: normal, 1: admin')
                ->default(0);
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
            $table->dropColumn('birthday');
            $table->dropColumn('address');
            $table->dropColumn('last_login_ip');
            $table->dropColumn('last_login_at');
            $table->dropColumn('type');
        });
    }
}
