<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('channels', function (Blueprint $table) {
            $table->foreignIdFor(User::class)
                ->after('name')
                ->constrained();
        });

        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::table('channels', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
