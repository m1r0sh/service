<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $schemaName = 'system_service';
        $schemaExists = DB::select("
            SELECT schema_name
            FROM information_schema.schemata WHERE schema_name = ?", [$schemaName]);
        if(empty($schemaExists)){
            DB::statement('CREATE SCHEMA '.$schemaName);
        }

        Schema::create('system_service.executors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_service.executors');
        DB::statement('DROP SCHEMA IF EXISTS system_service CASCADE');
    }
};
