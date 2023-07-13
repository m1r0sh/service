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
            Schema::create('services', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description');
                $table->string('status');
                $table->string('owner_email')->nullable();
                $table->timestamp('start_date')->nullable();
                $table->timestamp('end_date')->nullable();

                $table->unsignedBigInteger('executor_id')->nullable()->default(0);
                $table->unsignedBigInteger('service_type_id')->nullable()->default(0);

                $table->foreign('executor_id')->references('id')->on('executors')->onDelete('cascade');
                $table->foreign('service_type_id')->references('id')->on('service_types')->onDelete('cascade');

                $table->timestamps();
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
