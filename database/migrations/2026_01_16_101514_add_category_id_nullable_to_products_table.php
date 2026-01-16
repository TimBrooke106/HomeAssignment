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
        Schema::table('products', function (Blueprint $table) {
            // Add the column (nullable if you already have products)
            $table->foreignId('category_id')
                  ->nullable()
                  ->after('id');

            // Add the FK constraint (separate line is fine)
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
