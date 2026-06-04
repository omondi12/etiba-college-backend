<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('sort_order')->default(0);
            $table->string('name');
            $table->string('role')->nullable();
            $table->text('quote');
            $table->unsignedTinyInteger('rating')->default(5);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_archived')->default(false);
            $table->timestampTz('archived_at')->nullable();
            $table->uuid('archived_by')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
            $table->softDeletesTz();
            $table->timestampsTz();
        });
    }
    public function down(): void { Schema::dropIfExists('testimonials'); }
};
