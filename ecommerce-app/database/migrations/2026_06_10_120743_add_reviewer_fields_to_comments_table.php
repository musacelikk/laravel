<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        DB::statement('ALTER TABLE comments ALTER COLUMN user_id DROP NOT NULL');

        Schema::table('comments', function (Blueprint $table) {
            $table->string('reviewer_name')->nullable();
            $table->string('reviewer_email')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['reviewer_name', 'reviewer_email']);
        });

        DB::statement('ALTER TABLE comments ALTER COLUMN user_id SET NOT NULL');

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }
};
