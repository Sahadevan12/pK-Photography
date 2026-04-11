<?php
// app/Models/CustomerUpload.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'product_id', 'file_path', 'original_name',
        'customer_name', 'customer_phone', 'notes', 'status'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}