<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('products')) {
            return;
        }

        if (Schema::hasColumn('products', 'name') && ! Schema::hasColumn('products', 'title')) {
            if (Schema::getConnection()->getDriverName() === 'pgsql') {
                DB::statement('ALTER TABLE products RENAME COLUMN name TO title');
            } else {
                Schema::table('products', function (Blueprint $table) {
                    $table->string('title')->nullable();
                });

                DB::table('products')->orderBy('id')->each(function ($product) {
                    DB::table('products')->where('id', $product->id)->update(['title' => $product->name]);
                });

                Schema::table('products', function (Blueprint $table) {
                    $table->dropColumn('name');
                });
            }
        }

        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'keywords')) {
                $table->string('keywords')->nullable()->after('title');
            }
            if (! Schema::hasColumn('products', 'detail')) {
                $table->text('detail')->nullable()->after('description');
            }
            if (! Schema::hasColumn('products', 'quantity')) {
                $table->unsignedInteger('quantity')->default(0)->after('price');
            }
            if (! Schema::hasColumn('products', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('quantity')->constrained()->nullOnDelete();
            }
            if (! Schema::hasColumn('products', 'status')) {
                $table->string('status')->default('active')->after('user_id');
            }
        });

        if (Schema::hasColumn('products', 'stock')) {
            if (! Schema::hasColumn('products', 'quantity')) {
                Schema::table('products', function (Blueprint $table) {
                    $table->unsignedInteger('quantity')->default(0)->after('price');
                });
            }

            DB::table('products')->orderBy('id')->each(function ($product) {
                DB::table('products')->where('id', $product->id)->update([
                    'quantity' => $product->stock ?? 0,
                ]);
            });

            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('stock');
            });
        }
    }

    public function down(): void
    {
        //
    }
};
