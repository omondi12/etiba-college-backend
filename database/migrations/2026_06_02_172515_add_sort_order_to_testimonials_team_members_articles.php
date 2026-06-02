<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        foreach (['testimonials', 'team_members', 'articles'] as $table) {
            Schema::table($table, function (Blueprint $t) {
                $t->integer('sort_order')->default(0)->after('id');
            });
        }
    }
    public function down(): void {
        foreach (['testimonials', 'team_members', 'articles'] as $table) {
            Schema::table($table, function (Blueprint $t) {
                $t->dropColumn('sort_order');
            });
        }
    }
};
