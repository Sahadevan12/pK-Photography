<?php
// app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'short_description',
        'price', 'sale_price', 'main_image', 'gallery_images',
        'allow_custom_image', 'custom_image_label', 'stock',
        'is_featured', 'is_active'
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'allow_custom_image' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getMainImageUrlAttribute(): string
    {
        return asset('storage/' . $this->main_image);
    }

    public function getCurrentPriceAttribute(): float
    {
        return $this->sale_price ?? $this->price;
    }

    public function getDiscountPercentAttribute(): ?int
    {
        if ($this->sale_price && $this->price > 0) {
            return round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return null;
    }
}