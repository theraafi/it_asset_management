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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_tag', 30)->unique(); // GBIL-ICT-123456
            $table->string('name');
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable()->unique(); // many NULLs allowed
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained()->nullOnDelete();
            $table->date('assigned_at')->nullable();
            $table->foreignId('location_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('vendor_id')->nullable()->constrained()->nullOnDelete();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_price', 12, 2)->nullable(); // unit price, never float
            $table->string('invoice_number')->nullable();
            $table->date('warranty_expiry')->nullable();
            $table->string('item_condition', 20)->default('new');
            $table->string('status', 20)->default('in_stock')->index();
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
