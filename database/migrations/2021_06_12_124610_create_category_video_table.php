<?php

use App\Models\Category;
use App\Models\Video;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('category_video', function (Blueprint $table) {
            $table->primary(['category_id', 'video_id']);
            $table->foreignIdFor(Category::class)->constrained();
            $table->foreignIdFor(Video::class)->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_video');
    }
};
