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
        Schema::table('timesheets', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\User::class);
            $table->foreignIdFor(\App\Models\Company::class);
            $table->foreignIdFor(\App\Models\Client::class);
            $table->foreignIdFor(\App\Models\Project::class);
            $table->foreignIdFor(\App\Models\Activity::class);
            $table->decimal('hours');
            $table->date('day');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('timesheets', function (Blueprint $table) {
            //
        });
    }
};
