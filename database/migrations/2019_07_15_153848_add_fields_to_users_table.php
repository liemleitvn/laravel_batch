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
            $table->string('last_login_ip')->after('remember_token');
            $table->string('last_login_at')->after('last_login_ip');
            $table->string('provider')->nullable()->after('remember_token');
            $table->string('provider_id')->nullable()->after('provider');
            $table->text('avatar')->nullable()->after('provider_id');
            $table->integer('number_of_resend_verify')->default(0)->after('email_verified_at');
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
            $table->dropColumn('provider');
            $table->dropColumn('provider_id');
            $table->dropColumn('avatar');
            $table->dropColumn('number_of_resend_verify');
        });
    }
}
