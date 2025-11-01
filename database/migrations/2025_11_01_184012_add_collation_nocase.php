<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('tarea',100)->unique()->collate('NOCASE')->change();
            $table->text('descripcion')->nullable()->collate('NOCASE')->change();
        });

        Schema::table('managers', function (Blueprint $table) {
            $table->string('nombre',60)->collate('NOCASE')->change();
            $table->string('cargo',60)->collate('NOCASE')->change();
        });
        */
        Schema::table('cities', function (Blueprint $table) {
            $table->string('ciudad',60)->collate('NOCASE')->change();
            $table->string('pais',60)->collate('NOCASE')->change();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('tarea',100)->unique()->change();
            $table->text('descripcion')->nullable()->change();
        });

        Schema::table('managers', function (Blueprint $table) {
            $table->string('nombre',60)->change();
            $table->string('cargo',60)->change();
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->string('ciudad',60)->change();
            $table->string('pais',60)->change();
        });        
    }
};
