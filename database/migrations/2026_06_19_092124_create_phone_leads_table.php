<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('phone_leads', function (Blueprint $table) {
            $table->id();
            $table->string('vapi_call_id')->nullable()->unique();
            $table->string('caller_number')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('reason')->nullable();
            $table->string('preferred_time')->nullable();
            $table->string('recording_url')->nullable();
            $table->text('transcript')->nullable();
            $table->json('messages')->nullable();
            $table->text('summary')->nullable();
            $table->string('ended_reason')->nullable();
            $table->timestamp('call_started_at')->nullable();
            $table->timestamp('call_ended_at')->nullable();
            $table->enum('status', ['new', 'contacted', 'booked'])->default('new');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('phone_leads');
    }
};
