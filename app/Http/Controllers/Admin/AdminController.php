<?php
// app/Http/Controllers/Admin/AdminController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\CustomerUpload;
use App\Models\HeroImage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_orders'    => Order::count(),
            'pending_orders'  => Order::where('status', 'pending')->count(),
            'total_products'  => Product::count(),
            'total_categories'=> Category::count(),
            'total_uploads'   => CustomerUpload::count(),
            'total_revenue'   => Order::whereIn('status', ['confirmed','processing','shipped','delivered'])->sum('total'),
            'hero_images'     => HeroImage::count(),
        ];

        $recentOrders = Order::with('items')
            ->latest()
            ->take(8)
            ->get();

        $topProducts = Product::withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'topProducts'));
    }
}