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
        Schema::create('renewal_logs', function (Blueprint $table) {
            $table->id();
                $table->foreignId('subscription_id')->constrained()->onDelete('cascade');
                $table->string('status');
                $table->timestamp('run_at');
                $table->text('message')->nullable();
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renewal_logs');
    }
};
