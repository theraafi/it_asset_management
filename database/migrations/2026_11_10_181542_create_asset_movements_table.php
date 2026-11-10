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
        Schema::create('asset_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained()->cascadeOnDelete();
            $table->string('type', 20);
            $table->foreignId('from_employee_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->foreignId('to_employee_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->foreignId('location_id')->nullable()->constrained()->nullOnDelete();
            $table->date('movement_date');
            $table->date('expected_return_date')->nullable();
            $table->string('item_condition', 20)->nullable();
            $table->string('status_after', 20)->nullable();
            $table->text('remarks')->nullable();
            $table->foreignId('performed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->index(['asset_id', 'movement_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_movements');
    }
};
