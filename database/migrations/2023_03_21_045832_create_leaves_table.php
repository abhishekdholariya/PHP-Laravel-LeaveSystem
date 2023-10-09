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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->text('description');
            $table->date('from');
            $table->date('to');
            $table->string('type')->comment('casual, sick, On duty , C off, Half, other');
            $table->string('attachment')->nullable();
            $table->integer('substitute_staff_id')->nullable();
            $table->string('substitute_staff_status')->default('pending')->comment('pending, approved, rejected');
            $table->string('hod_status')->default('pending')->comment('pending, approved, rejected');
            $table->string('principal_status')->default('pending')->comment('pending, approved, rejected');
            $table->string('status')->default('pending')->comment('pending, approved, rejected');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
