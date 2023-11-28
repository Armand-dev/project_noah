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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('prefix');
            $table->integer('number');
            $table->foreignIdFor(\App\Models\Company::class);
            $table->foreignIdFor(\App\Models\User::class);

            $table->foreignIdFor(\App\Models\Client::class)->nullable();
            $table->foreignIdFor(\App\Models\Project::class)->nullable();

            $table->string('title');
            $table->integer('priority')->nullable();
            $table->date('due_date')->nullable();
            $table->decimal('hours')->nullable();
            $table->integer('status')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
