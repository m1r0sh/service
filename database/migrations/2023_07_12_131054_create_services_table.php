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
        if (!Schema::hasTable('services')){
            Schema::create('services', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description');
                $table->string('status');
                $table->timestamp('start_date')->nullable();
                $table->timestamp('end_date')->nullable();

                $table->unsignedBigInteger('executor_id');
                $table->unsignedBigInteger('service_type_id');

                $table->foreign('executor_id')->references('id')->on('executors')->cascadeOnDelete();
                $table->foreign('service_type_id')->references('id')->on('service_types')->cascadeOnDelete();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
