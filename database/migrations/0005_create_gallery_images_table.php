<?php
// database/migrations/xxxx_create_gallery_images_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('gallery_images', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('title')->nullable();
            $table->string('category')->default('wedding');
            // wedding, portrait, pre-wedding, events
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('customer_uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('set null');
            $table->string('file_path');
            $table->string('original_name');
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('pending'); // pending, processed
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('customer_uploads');
        Schema::dropIfExists('gallery_images');
    }
};