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
        $schemaName = 'log';
        $schemaExists = DB::select("
            SELECT schema_name
            FROM information_schema.schemata WHERE schema_name = ?", [$schemaName]);
        if(empty($schemaExists)){
            DB::statement('CREATE SCHEMA '.$schemaName);
        }

        Schema::create('log.user_actions', function (Blueprint $table) {
            $table->id();
            $table->date('action_at');
            $table->string('role')->nullable();
            $table->string('level')->nullable();
            $table->integer('action');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log.user_actions');
    }
};
