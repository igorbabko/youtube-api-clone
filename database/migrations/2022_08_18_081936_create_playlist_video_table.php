<?php

use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('playlist_video', function (Blueprint $table) {
            $table->primary(['playlist_id', 'video_id']);
            $table->foreignIdFor(Playlist::class)->constrained();
            $table->foreignIdFor(Video::class)->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('playlist_video');
    }
};
