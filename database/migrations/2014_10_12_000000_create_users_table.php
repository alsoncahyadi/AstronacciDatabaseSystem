<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('username');
            $table->string('fullname')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_handphone')->nullable();
            $table->integer('role');
            $table->integer('a_shop_auth');     
            $table->rememberToken();
            $table->timestamps();
        });

        $admin_user = new App\User;
        $admin_user->id = 0;
        $admin_user->username = 'superadmin';
        $admin_user->fullname = 'superadmin';
        $admin_user->email = '-';
        $admin_user->password = bcrypt('iamthebest');
        $admin_user->no_handphone = '-';
        $admin_user->role = 0;
        $admin_user->a_shop_auth = 1;
        $admin_user->remember_token = '-';
        $admin_user->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
