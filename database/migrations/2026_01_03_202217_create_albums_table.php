<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
Schema::create('albums', function (Blueprint $table) {
$table->id(); // Auto-incrementing ID
$table->string('name'); // Naam van het album
$table->string('artists'); // Naam van de artiesten
$table->string('genre'); // Genre
$table->integer('year'); // Release year
$table->string('image_path')->nullable(); // Afbeelding (optioneel)
$table->timestamps(); // Created_at en Updated_at timestamps
});
}

public function down(): void
{
Schema::dropIfExists('albums');
}
};
