<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gallery', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('sort_order')->default(0);
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('image_path');
            $table->string('category')->nullable();
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
    public function down(): void { Schema::dropIfExists('gallery'); }
};
