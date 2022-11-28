<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddsUserRoleIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
           $table
               ->foreignIdFor(Role::class)
               ->nullable()
               ->references('id')
               ->on('roles');
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
           $table->dropForeign('users_role_id_foreign');
        });
    }
}
