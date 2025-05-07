<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_media', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('Id_project');
            $table->integer('NumFile_ProjectMedia')->nullable(); // Позиция файла
            $table->string('File_ProjectMedia'); // Имя файла
            $table->timestamps();

            $table->foreign('Id_project')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_media');
    }
};
