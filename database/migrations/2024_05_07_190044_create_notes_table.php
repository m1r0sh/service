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
        $schemaName = 'note_tables';
        $schemaExists = DB::select("
            SELECT schema_name
            FROM information_schema.schemata WHERE schema_name = ?", [$schemaName]);
        if(empty($schemaExists)){
            DB::statement('CREATE SCHEMA '.$schemaName);
        }

        Schema::create('note_tables.notes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content')->nullable();
            $table->boolean('status')->default(false);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('public.users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('note_tables.notes');
    }
};
