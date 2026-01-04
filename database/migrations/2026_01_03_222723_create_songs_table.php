<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
Schema::create('songs', function (Blueprint $table) {
$table->id();
$table->foreignId('album_id')->constrained()->onDelete('cascade'); // koppeling naar albums
$table->string('title');          // naam van het liedje
$table->integer('track_number');  // tracknummer in album
$table->integer('duration')->nullable(); // duur in seconden
$table->timestamps();
});
}

public function down(): void
{
Schema::dropIfExists('songs');
}
};


