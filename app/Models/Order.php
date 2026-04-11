<?php
// app/Models/Order.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', 'customer_name', 'customer_phone', 'customer_email',
        'customer_address', 'city', 'pincode', 'subtotal', 'discount',
        'total', 'status', 'notes', 'whatsapp_sent'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateOrderNumber(): string
    {
        return 'PK' . strtoupper(uniqid());
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending'    => 'bg-yellow-100 text-yellow-700',
            'confirmed'  => 'bg-blue-100 text-blue-700',
            'processing' => 'bg-purple-100 text-purple-700',
            'shipped'    => 'bg-indigo-100 text-indigo-700',
            'delivered'  => 'bg-green-100 text-green-700',
            'cancelled'  => 'bg-red-100 text-red-700',
            default      => 'bg-gray-100 text-gray-700',
        };
    }
}