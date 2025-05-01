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
            // Thêm category_id
            if (!Schema::hasColumn('products', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->after('status');
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            }



            // Cho phép description và image nullable
            $table->text('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Nếu rollback thì xóa khóa ngoại + cột category_id
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');

            // rollback các cột về dạng cũ nếu cần
            $table->enum('status', ['in-stock', 'out-stock'])->default('in-stock')->change();
            $table->text('description')->nullable(false)->change();
            $table->string('image')->nullable(false)->change();
        });
    }
};
