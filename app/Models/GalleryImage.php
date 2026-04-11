<?php
// app/Models/GalleryImage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path', 'title', 'category',
        'is_featured', 'is_active', 'sort_order'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }
}