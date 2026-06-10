<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('categories')) {
            return;
        }

        if (Schema::hasColumn('categories', 'name') && ! Schema::hasColumn('categories', 'title')) {
            if (Schema::getConnection()->getDriverName() === 'pgsql') {
                DB::statement('ALTER TABLE categories RENAME COLUMN name TO title');
            } else {
                Schema::table('categories', function (Blueprint $table) {
                    $table->string('title')->nullable();
                });

                DB::table('categories')->orderBy('id')->each(function ($category) {
                    DB::table('categories')->where('id', $category->id)->update(['title' => $category->name]);
                });

                Schema::table('categories', function (Blueprint $table) {
                    $table->dropColumn('name');
                });
            }
        }

        Schema::table('categories', function (Blueprint $table) {
            if (! Schema::hasColumn('categories', 'keywords')) {
                $table->string('keywords')->nullable()->after('title');
            }
            if (! Schema::hasColumn('categories', 'description')) {
                $table->text('description')->nullable()->after('keywords');
            }
            if (! Schema::hasColumn('categories', 'image')) {
                $table->string('image')->nullable()->after('description');
            }
            if (! Schema::hasColumn('categories', 'status')) {
                $table->string('status')->default('active')->after('image');
            }
        });

        if (Schema::hasColumn('categories', 'sort_order')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }

    }

    public function down(): void
    {
        //
    }
};
