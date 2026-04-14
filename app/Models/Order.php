<?php
// app/Models/Order.php — Add this method
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number', 'customer_name', 'customer_phone', 'customer_email',
        'customer_address', 'city', 'pincode', 'subtotal', 'discount',
        'total', 'status', 'notes', 'whatsapp_sent'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // ✅ Generate unique readable Order ID
    public static function generateOrderNumber(): string
    {
        do {
            // Format: PK-2024-XXXXX
            $number = 'PK' . date('Y') . strtoupper(substr(uniqid(), -5));
        } while (self::where('order_number', $number)->exists());

        return $number;
    }
}