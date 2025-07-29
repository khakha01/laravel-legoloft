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
        Schema::create('order_history_assemblies', function (Blueprint $table) {
            $table->id();
            $table->string('status_name');
            $table->unsignedBigInteger('assembly_id');
            $table->foreign('assembly_id')->references('id')->on('assemblies')->onUpdate('restrict')->onDelete('restrict');
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('administrations')->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_history_assemblies');
    }
};